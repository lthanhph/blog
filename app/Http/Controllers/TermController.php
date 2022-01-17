<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\PostTerm;
use App\Models\Taxonomy;
use App\Models\Post;
use Illuminate\Support\Facades\View;

class TermController extends Controller
{
    //
    public function index(Request $request, $tax_name)
    {
        $data = [
            'terms' => Term::whereRelation('taxonomy', 'name', $tax_name)->paginate(10),
            'tax_name' => $tax_name
        ];
        if ($request->has('ajax_pagination')) {
            $view = response()->view('admin.path.table.term', $data);
        } else {
            $view = view('admin.path.term', $data);
        }
        return $view;
    }

    /**
     * @param string|array $title
     * @return boolean|Collection
     */
    public static function storeByTitle($title, $tax_name)
    {
        $tax = Taxonomy::firstWhere('name', $tax_name);
        if (empty($tax) || empty($title)) {
            return false;
        }

        $terms = [];
        foreach ((array) $title as $t) {
            $terms[] = [
                'title' => $t,
                'taxonomy_id' => $tax->id
            ];
        }

        $terms = Term::createMany($terms);

        return $terms;
    }

    public static function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);
        $tax = Taxonomy::firstWhere('name', $request->input('tax_name'));
        if (empty($tax)) {
            return;
        }
        $validated['taxonomy_id'] = $tax->id;
        Term::create($validated);

        return redirect()->route('term.index', ['tax_name' => $tax->name]);

        // return response()->view(
        //     'admin.path.table.term',
        //     [
        //         'terms' => Term::whereRelation('taxonomy', 'name', $tax->name)->get(),
        //         'tax_name' => $tax->name
        //     ]
        // );
    }

    public function edit($id) {
        return view('admin.path.term-edit', ['term' => Term::find($id)]);
    }

    public static function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);
        $term = Term::find($id);
        $term->update($validated);

        return redirect()->route('term.index', $term->taxonomy->name);

        // return response()->view('admin.path.table.term', [
        //     'terms' => Term::whereRelation('taxonomy', 'name', $term->taxonomy->name)->paginate(10),
        //     'tax_name' => $term->taxonomy->name
        // ]);
    }

    public static function destroy(Request $request, $id)
    {
        $term = Term::find($id);
        $tax_name = $term->taxonomy->name;
        $term->post()->detach();
        $term->delete();

        return redirect()->route('term.index', [
            'terms' => Term::whereRelation('taxonomy', 'name', $tax_name)->paginate(10),
            'tax_name' => $tax_name,
        ]);

        // $terms = Term::whereRelation('taxonomy', 'name', $tax_name)->paginate(10)->withPath(route('term.index', ['tax_name' => $tax_name]));
        
        // return response()->view('admin.path.table.term', [
        //     'terms' => $terms,
        //     'tax_name' => $tax_name
        // ]);
    }

    public static function archive($id)
    {
        $term = Term::find($id);
        return view('public.path.term-archive', [
            'term' => $term,
            'post' => $term->post()->paginate(10),
        ]);
    }

    // public static function ajaxPagination($tax_name)
    // {
    //     $data = [
    //         'terms' => Term::whereRelation('taxonomy', 'name', $tax_name)->paginate(10)->withPath('ajax_pagination'),
    //         'tax_name' => $tax_name,
    //     ];

    //     return response()->view('admin.path.table.term', $data);
    // }
}
