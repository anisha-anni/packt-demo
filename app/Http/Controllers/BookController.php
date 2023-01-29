<?php
namespace App\Http\Controllers;
use DB;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;
use DateTime;
use Http;

class BookController extends Controller {

  public function addFakeBooks(){
    $bookRes = Http::get('https://fakerapi.it/api/v1/books?_quantity=50')->json();
    $bookRes = $bookRes['data'];
    foreach($bookRes as $book){
      
      $saveBookArr = [
        'title' => $book['title'],
        'author' => $book['author'],
        'genre' => $book['genre'],
        'description' => $book['description'],
        'isbn' => $book['isbn'],
        'image' => $book['image'],
        'published' => $book['published'],
        'publisher' => $book['publisher'],
        'created_at' => date('Y-m-d')
      ];
      Book::addBook($saveBookArr);
    }
  }

  public function bookRequest(){    
      $formCount    = 0;
      $divToShow    = 0;     
      $bookDetails = Book::getBookRequest();
      $countBookRequests = Book::countBookRequest();
      return view('view_books')
            ->with('bookDetails', $bookDetails)
            ->with('countBookRequests', $countBookRequests)
            ->with('formCount', $formCount)
            ->with('divToShow', $divToShow)
            ->with('default_limit', 50);
    
  }

  public function isExistBookTitle(Request $request){        
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            $errorArray = json_decode($validator->errors(), true);
            $error = current($errorArray);
            $message['message'] = $error[0];
            return 3;
        }
        
        $title = trim($request->title);
        if(array_key_exists('title', $request->all())) {
            $validateTitle = Validator::make($request->all(), ['title' => 'unique:books']); 
            if ($validateTitle->fails()) {
                 return 1;
            }else{
                return 0;
            }
        }        
  }  

  public function addBook(Request $request){
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'author' => 'required',
        'genre' => 'required',
        'description' => 'required',
        'isbn' => 'required',
        'published' => 'required',
        'publisher' => 'required'
        ]);

      if ($validator->fails()) {
          $errorArray = json_decode($validator->errors(), true);
          $error      = current($errorArray);
          $message    = $error[0];
          return 0;
      }

      $title = trim($request->title);
      $dirName = strtolower(str_replace(' ', '_', $title));
      $author = trim($request->author);
      $genre = trim($request->genre);
      $isbn = trim($request->isbn);
      $description = trim($request->description);
      $publisher = trim($request->publisher);
      $published = trim($request->published);
      $published = str_replace('/', '-', $published);
      $publishedArr = explode('-', $published);
      $published = $publishedArr[2].'-'.$publishedArr[1].'-'.$publishedArr[0];
      $createdAt =  gmdate("Y-m-d H:i:s");

      $coverPicURL = "";
          if (!empty($_FILES['cover_image']['name'])) {
            if (isset($_FILES['cover_image']['name'])) {
              if ($_FILES['cover_image']['size'] > 0) {
                $file = $request->file('cover_image');
                $originalName = $file->getClientOriginalName();
                $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                $file_name = 'img_' . time() . '.' . $ext; 
                $path = $file->storeAs($dirName, $file_name, 'public');
                $coverPicURL = 'storage/app/public/'. $path;
              }
            }
          }

      $inputDataArray = [
        'title'         => $title,
        'author'        => $author,
        'genre'         => $genre,
        'description'   => $description,
        'isbn'          => $address,
        'image'         => $coverPicURL,
        'published'     => $published,
        'publisher'     => $publisher,
        'created_at'    => $createdAt
        ];   
          

          $id = Book::addBook($inputDataArray);

          
          $message = 'Book added successfully.';
          Session::put('class', 'alert-success');
          Session::flash('message', $message);
          return Redirect::action('App\Http\Controllers\BookController@bookRequest');
    
  }

  public function viewBookDetail($id) {
    $id = trim($id);
    $bookDetails = Book::getBookDetailById($id);
    return view('view_book_detail')
            ->with('bookDetails', $bookDetails);
  }

  public function showEditBookInfo($id) {
    $id = trim($id);
    $bookDetails = Book::getBookDetailById($id);
    return view('edit_book_info')
            ->with('bookDetails', $bookDetails);
  }

  public function ediBookInfo(Request $request) {
    $validator = Validator::make($request->all(), [
        'id' => 'required'
        ]);

      if ($validator->fails()) {
        $errorArray = json_decode($validator->errors(), true);
        $error      = current($errorArray);
        $message    = $error[0];
        return 0;
      }

      
      $id =  trim($request->id);
      $title = trim($request->title);
      $dirName = strtolower(str_replace(' ', '_', $title));
      $author = trim($request->author);
      $genre = trim($request->genre);
      $isbn = trim($request->isbn);
      $description = trim($request->description);
      $publisher = trim($request->publisher);
      $published = trim($request->published);
      $published = str_replace('/', '-', $published);
      $publishedArr = explode('-', $published);
      $published = $publishedArr[2].'-'.$publishedArr[1].'-'.$publishedArr[0];      
      $updatedAt =  gmdate("Y-m-d H:i:s");
      $inputDataArray = "";

      
      $coverPicURL = "";
      if (!empty($_FILES['cover_image']['name'])) {
            if (isset($_FILES['cover_image']['name'])) {
              if ($_FILES['cover_image']['size'] > 0) {
                $file = $request->file('cover_image');
                $originalName = $file->getClientOriginalName();
                $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                $file_name = 'img_' . time() . '.' . $ext; 
                $path = $file->storeAs($dirName, $file_name, 'public');
                $coverPicURL = 'storage/app/public/'. $path;
              }
            }
          }

      if($coverPicURL != ""){
        $inputDataArray = [
            'title'         => $title,
            'author'        => $author,
            'genre'         => $genre,
            'description'   => $description,
            'isbn'          => $address,
            'image'         => $coverPicURL,
            'published'     => $published,
            'publisher'     => $publisher,
            'updated_at'    => $updatedAt
            ]; 
      }else{
        $inputDataArray = [
          'title'         => $title,
          'author'        => $author,
          'genre'         => $genre,
          'description'   => $description,
          'isbn'          => $address,
          'published'     => $published,
          'publisher'     => $publisher,
          'updated_at'    => $updatedAt
            ]; 
      }
          Book::editBook($inputDataArray, $id);

          $message = 'Book details updated successfully.';
          Session::put('class', 'alert-success');
          Session::flash('message', $message);
          return Redirect::action('App\Http\Controllers\BookController@bookRequest');
  }

  public function deleteBook(Request $request) {
       $input = $request->all();
       $validator = Validator::make($input, [
          'id' => 'required'
       ]);
       if ($validator->fails()) {
        $errorArray = json_decode($validator->errors(), true);
        $error      = current($errorArray);
        $message    = $error[0];
        return 0;
       }
       $id = trim($request->id);

       $save = Book::deleteBookById($id);
       if ($save) {
        return 1;
       } else {
        return 0;
       }
  }

  public function searchBooks(Request $request) {
      $inputValue = $request->all();
      $searchIn   = $request->search_in;
      for($i=0; $i<count($searchIn); $i++) {
        if ($searchIn[$i] == 'created_at' || $searchIn[$i] == 'published') {
          $searchType[$i] = 'exact_match';
        }
        else {
          $searchType[$i] = $request->search_type[$i];
        }
      }
      $suggestionText = $request->suggestion_text;
      $formCount      = $request->formCount;
      $divToShow      = $request->divToShow;
      $limitFlag      = $request->limit_flag;
      $dateFilters = $request->datefilter;
      $startDate = array();
      $endDate   = array();
      foreach($dateFilters as $dateFilter) {
        if ($dateFilter != "") {
          $splitDateFilter = explode(' ~ ', $dateFilter);
          $startDateFilter = $splitDateFilter[0] . " 00:00:00";
          $startDateFilterFormat  =   date("Y/m/d H:i:s", strtotime($startDateFilter));
          $endDateFilter = $splitDateFilter[1] . " 23:59:59";
          $endDateFilterFormat = date("Y/m/d H:i:s", strtotime($endDateFilter));
          $timezone   = "Asia/Kolkata";
          $start_date = \BookHelper::ConvertLocalTimezoneToGMT($startDateFilterFormat, $timezone);
          $end_date   = \BookHelper::ConvertLocalTimezoneToGMT($endDateFilterFormat, $timezone);
        } else {
            $start_date = '';
            $end_date   = '';
          }
          $startDate[] = $start_date;
          $endDate[] = $end_date;
      }
      $bookDetails = Book::getSearchBooks($searchIn, $searchType, $suggestionText, $startDate, $endDate, $limitFlag);
      $countBookRequests = count($bookDetails);
      return view('view_books')->with(['bookDetails' => $bookDetails, 'countBookRequests' =>$countBookRequests, 'inputValue' => $inputValue, 'searchType' => $searchType, 'formCount' => $formCount, 'divToShow' => $divToShow]);
   
  }

}
