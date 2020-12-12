<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Redirect;
use App\Book;
use App\Person;
use App\BookIssue;
class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     //Check for api auth using json webtoken or using session
    public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = $this->getAllBooks();
        return view('books', compact('books'));
    }

    //Returns all the books 
    public function getAllBooks()
    {
        return Book::orderBy('book_name', 'asc')->get();         
    }

    //Add New Book
    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(),[ 
            'book_name' => 'required|regex:/^[a-z A-Z]+$/u|max:255|unique:books'
        ]);
        if ($validator->fails()) 
        {
            $books = $this->getAllBooks();
            $errors = $validator->messages();
            return view('books', compact('books', 'errors'));
        }

        $book_name = $request->get('book_name');
        $book = new Book;
        $book->book_name = $book_name;
        $book->save();
        $books = $this->getAllBooks();
        $message = 'Book added successfully...!';

        return view('books', compact('books', 'message'));
    }
    //Book Issue Form 
    public function getPeople()
    {
        return Person::orderBy('name', 'asc')->pluck('name', 'id');
    }
    public function getBooks()
    {
        return Book::orderBy('book_name', 'asc')->pluck('book_name', 'id');
    }
    public function issueBook()
    {
        $people = $this->getPeople();
        $books = $this->getBooks();
        return view('issuebooks', compact('people', 'books'));
    }

    //Check Book already issued to the person
    public function checkBookAlreadyIssued($book_id, $person_id)
    {
        $count = BookIssue::where("return_status", "=", 1)->where("book_id", "=", $book_id)->where('person_id', '=', $person_id)->count();
        
        if($count > 0)
        {
            return true;
        }
        return false;
    }
    //Check Book already issued to the person
    public function checkBookIssuedCount($person_id)
    {
        $count = BookIssue::where("return_status", "=", 1)->where('person_id', '=', $person_id)->count();
        if($count>=5)
        {
            return true;
        }
        return false;
    }
    //Store Issued Book in table
    public function storeBookIssued(Request $request)
    {
        $book_id = $request->get('book_id');
        $person_id = $request->get('person_id');
        $issue_date = $request->get('date');
        
        $validation1 = $this->checkBookAlreadyIssued($book_id,$person_id);
        $validation2 = $this->checkBookIssuedCount($person_id);
        $error = "";
        //If both the condition fail issue book
        if(!$validation1 && !$validation2)
        {
            $BookIssue = new BookIssue;
            $BookIssue->book_id = $book_id;
            $BookIssue->person_id = $person_id;
            $BookIssue->issue_date = $issue_date;
            $BookIssue->save();
                   
            $message = "Book issued successfully...!";
        }
        else if($validation1)
        {
            $error = "Book already issued to the selected person...!";
        }
        else if($validation2)
        {
            $error = "Max 5 books can be issued to a person...!";
        }

        $people = $this->getPeople();
        $books = $this->getBooks(); 
        return view('issuebooks', compact('people', 'books', "message", "error"));
    }

    //Returns Book Issued/Returned for selected date if date is not null else all issued/returned books will be returned
    //return_status = 1 -> Book Issued
    //return_status = 2 -> Book Returned
    public function getBookIssuedReturned($date = '', $return_status = 1, $type = 'issued')
    {
        $booksIssued = BookIssue::with('books')->with('person')->where('return_status', '=', $return_status);
        
        if($date!= '')
        {
            if($type == 'issued')
            {
                $booksIssued->where('issue_date', '=', $date);
            }
            else
            {
                $booksIssued->where('return_date', '=', $date);
            }
        }
        return $booksIssued = $booksIssued->get();
    }

    //Get List of issued books
    public function getAllBookIssued(Request $request)
    {
        $date = "";
        if($request->has('date'))
        {
            $date = $request->get('date');            
        }
        $booksIssued = $this->getBookIssuedReturned($date, 1);
        
        return view('books_issued', compact('booksIssued', 'date'));
        
    }

    //Return Books
    public function returnBook(Request $request)
    {
        $date = "";
        $validator = Validator::make($request->all(),[ 
            'return_date' => 'required|date_format:Y-m-d',
            'rent' => 'required|integer',
        ]);
        $errors = null;
        if ($validator->fails()) 
        {   
            $booksIssued = $this->getBookIssuedReturned($date, 1);
            $errors = $validator->messages();
            return view('books', compact('books', 'errors'));
        }
        
        $issue_id = $request->get('issue_id');
        $return_date = $request->get('return_date');
        $rent = $request->get('rent');
        
        $bookIssue = BookIssue::where('id', '=', $issue_id)->first();
        $bookIssue->return_date = $return_date;
        $bookIssue->rent = $rent;
        $bookIssue->return_status = 2;
        $bookIssue->save();
        $booksIssued = $this->getBookIssuedReturned($date, 1);
        $message = "Book returned successfully...!";
        return view('books_issued', compact('booksIssued', 'date', 'message'));
    }

    //Get List of returned books
    public function getBooksReturned(Request $request)
    {
        $date = "";
        if($request->has('date'))
        {
            $date = $request->get('date');            
        }
        $booksReturned = $this->getBookIssuedReturned($date, 2, 'returned');
        
        return view('books_returned', compact('booksReturned', 'date'));
    }
}
