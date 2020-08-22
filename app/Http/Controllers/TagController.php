<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResourceCollection;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Carbon;

class TagController extends Controller
{

    /** Finds tag names in the db, inserts them if new
     * 
     * @param Array $tagnames   // string array of tag names
     * @return TagResourceCollection    // collection of all tags found or inserted
     */
    public function getByNameOrInsert(Array $tagNames) : TagResourceCollection
    {
        $tagCollectionResult = $this->getTagsByName($tagNames);

        $existingNames = $tagCollectionResult->map(function($tagResource) {
            return $tagResource->name;
        });

        $inserts = $this->storeMany(array_diff($tagNames, $existingNames->all()));

        return new TagResourceCollection($tagCollectionResult->concat($inserts->all()));
    }

    /** Finds all existing recordsby name from a given array
     * 
     * @param Array $tagnames   // array of string values to be retrieved from the db
     * @return TagResourceCollection
     */
    public function getTagsByName(Array $tagNames) : TagResourceCollection
    {
        return new TagResourceCollection(Tag::whereIn('name', $tagNames)->get());
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

        return new TagResourceCollection(Tag::whereIn('name', $tagNames)->get());
    }
}
