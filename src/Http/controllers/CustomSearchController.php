<?php

// MyVendor\search\src\Http\Controllers\CustomSearchController.php

namespace MyVendor\Search\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MyVendor\Search\Models\CustomSearch;

class CustomSearchController extends Controller {

    public function index() {
        //phpinfo();
        $items = [];
        $results = '';
        if (isset($_GET['q'])) {
            $key = config('sp_mawdoo3_laravel.google_key');
            $q = trim(urlencode($_GET['q']));
            $cx = config('sp_mawdoo3_laravel.cx');
            $url = 'https://www.googleapis.com/customsearch/v1?key=' . $key . '&q=' . $q . '&cx=' . $cx . '&fields=kind,items(title,link,snippet)&alt=json';

            $results = file_get_contents($url);
            $searches = json_decode($results);
            if (isset($searches->items) && !empty($searches->items)) {
                $items = $searches->items;
            }
        }

        return view('search::index', ['items' => $items, 'results' => $results]);
    }

    public function results_save() {
        if (isset($_POST['save'])) {
            $searches = json_decode($_POST['results']);
            if (isset($searches->items) && !empty($searches->items)) {
                $items = $searches->items;
            }

            if (isset($_POST['checked']) && !empty($_POST['checked'])) {
                foreach ($_POST['checked'] as $check) {
                    $search = new CustomSearch;
                    $search->title = $items[$check]->title;
                    $search->description = $items[$check]->snippet;
                    $search->link = $items[$check]->link;
                    $search->comment = $_POST['comment_' . $check];
                    $search->save();
                }
            }

            return redirect(url('search/all_results'))->with(['message' => 'search results has been added successfully.']);
        }
    }

    public function all_results() {
        $searches = CustomSearch::all()->where('deleted_at', NULL);

        return view('search::results', ['records' => $searches]);
    }

    public function delete($id) {
        $result = CustomSearch::find($id);
        $result->deleted_at = date('Y-m-d H:i:s');
        $result->save();

        return redirect(url('search/all_results'))->with('success', 'search has been deleted');
    }

    public function edit(Request $request,$id) {
        unset($_POST['comment']);
        $request->validate([
            'comment' => '',
        ]);

        $result = CustomSearch::find($id);
        $result->comment = $request->post('comment');
        $result->save();

        return redirect(url('search/all_results'))->with('success', 'search has been updated');
    }

}
