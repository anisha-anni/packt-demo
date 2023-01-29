<?php

namespace App\Models;
use DB;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Book extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'genre',
        'description',
        'isbn',
        'image',
        'published',
        'publisher'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

      public static function addBook($saveBookArr) {
        $lastInsertedId = DB::table('books')
          ->insertGetId($saveBookArr);
        if($lastInsertedId) {        
          return $lastInsertedId;
        }else{
          return false;
        }
      }
    
      public static function countBookRequest(){
        $count = DB::table('books')
        ->count();
        return $count;
      }
    
      public static function getBookRequest(){
        $books = DB::table('books')
          ->select('id',
              'title',
              'author',
              'genre',
              'description',
              'isbn',
              DB::raw('IFNULL(image, "") AS "image"'),
              'published',
              'publisher',              
              'created_at',
              'updated_at'
            )
            ->limit(500)
            ->orderBy('books.id', 'DESC')
            ->get();
        return $books;
      }
    
      public static function getBookDetailById($id){
        $bookDetail = DB::table('books')
            ->where('id', $id)
            ->select('id',
              'title',
              'author',
              'genre',
              'description',
              'isbn',
              DB::raw('IFNULL(image, "") AS "image"'),
              'published',
              'publisher',
              'created_at',
              'updated_at'
            )
          ->first();
        return $bookDetail;
      }
        
      public static function editBook($inputDataArray, $id)
      {
        $save = DB::table('books')
          ->where('id', $id)
          ->update($inputDataArray);
        if($save) {        
          return 1;
        }else{
          return 0;
        }
    
      }
    
      public static function deleteBookById($id){
        $delete =  DB::table('books')
          ->where('id', $id)
          ->delete();
        if($delete){
          return true;
        }else{
          return false;
        }
      }
    
    
      public static function getSearchBooks($searchIn, $searchType, $suggestionText, $startDate, $endDate, $limitFlag) {
        $response = DB::table('books')
          ->select('id',
               'title',
              'author',
              'genre',
              'description',
              'isbn',
              DB::raw('IFNULL(image, "") AS "image"'),
              'published',
              'publisher',              
              'created_at',
              'updated_at'
            );
    
        for($i=0;$i<count($searchIn);$i++) {
          if($searchIn[$i] == 'created_at') {
            if($startDate[$i] != '' && $endDate[$i] != ''){
              $response = $response->whereBetween($searchIn[$i], [$startDate[$i], $endDate[$i]]);
            }
          }
          else if($searchIn == 'published') {
            if($startDate[$i] != '' && $endDate[$i] != ''){
              $response = $response->whereBetween($searchIn[$i], [$startDate[$i], $endDate[$i]]);
            }
          }
          else if($searchIn[$i] == 'title'){
            $fieldSearch[$i] = "title";
            if ($searchType[$i] == 'contains' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', '%'.$suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'begins_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', $suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'exact_match' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], '=', $suggestionText[$i]);
            }
            if ($searchType[$i] == 'ends_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i],'LIKE','%'.$suggestionText[$i]);
            }
          }
          else if($searchIn[$i] == 'author'){
            $fieldSearch[$i] = "author";
            if ($searchType[$i] == 'contains' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', '%'.$suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'begins_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', $suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'exact_match' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], '=', $suggestionText[$i]);
            }
            if ($searchType[$i] == 'ends_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i],'LIKE','%'.$suggestionText[$i]);
            }
          }
          else if($searchIn[$i] == 'genre'){
            $fieldSearch[$i] = "genre";
            if ($searchType[$i] == 'contains' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', '%'.$suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'begins_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', $suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'exact_match' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], '=', $suggestionText[$i]);
            }
            if ($searchType[$i] == 'ends_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i],'LIKE','%'.$suggestionText[$i]);
            }
          }
          else {
            $fieldSearch[$i] = "isbn";
            if ($searchType[$i] == 'contains' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', '%'.$suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'begins_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i], 'LIKE', $suggestionText[$i].'%');
            }
            if ($searchType[$i] == 'exact_match' && $suggestionText[$i]!='') {
    
             $response = $response->where($fieldSearch[$i], '=', $suggestionText[$i]);
            }
            if ($searchType[$i] == 'ends_with' && $suggestionText[$i]!='') {
              $response = $response->where($fieldSearch[$i],'LIKE','%'.$suggestionText[$i]);
            }
          }
        }
        $response = $response
          ->limit($limitFlag)
          ->orderBy('id', 'DESC')
          ->get();
        return $response;
    }
}
