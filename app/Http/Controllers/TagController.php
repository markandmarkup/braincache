<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResourceCollection;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Carbon;

class TagController extends Controller
{

    /** Removes tag names that already exist in the database
     * 
     * @param Array $tagnames   // array of string values to be compared against the db
     * @return Array    // all values that do not have a match in the db
     */
    public function filterExistingTagsByName(Array $tagNames) : Array
    {
        $existingTags = Tag::whereIn('name', $tagNames)->pluck('name');

        return array_diff($tagNames, $existingTags->all());
    }

    /** Takes an array of tag names and inserts each one as a new db row
     * 
     * @param Array $tagNames   // simple string array of tag 'name' fields
     * @return TagResourceCollection    // returns collection of Tags matching the date of the $now value
     */
    public function storeMany(Array $tagNames) : TagResourceCollection
    {
        $now = Carbon::now();

        $tagArray = array_map(function($tagname) use ($now) {
            return array(
                'name' => $tagname,
                'created_at' => $now,
                'updated_at' => $now
            );
        }, $tagNames);

        Tag::insert($tagArray);

        return new TagResourceCollection(Tag::where('created_at', $now)->get());
    }
}
