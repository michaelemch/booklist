<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    //
    public function index(Request $request) {
        return Book::all();
    }

    public function delete($id) {
        $book = Book::find($id);
        if ($book) {
            $rc = $book->delete();
            if ($rc) {
                return response()->json("Object deleted successfully.", 204);
            }
            else {
                return response()->json("Error deleting object.", 500);
            }
        }
        else {
            return response()->json("Object not found.", 404);
        }
    }

    public function add(Request $request) {
        return Book::create($request->all());

    }

    public function edit($id) {
        $book = Book::find($id);
        return response()->json($book);
    }

    public function update($id, Request $request) {
        $book = Book::find($id);
        $book->update($request->all());
       
        return response()->json('Object updated successfully.');
    }

    public function update_all(Request $request) {
        foreach ($request->data as $data) {
            $book = new Book([
                'title' => $data["title"],
                'author' => $data["author"],
                'order' => $data["order"]
            ]);
            $book->update();
        }
        return response()->json('Objects saved successfully.');
    }
}