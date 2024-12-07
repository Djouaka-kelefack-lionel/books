use Illuminate\Support\Str;

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories',
        'description' => 'nullable|string'
    ]);

    // Générer le slug à partir du nom
    $validated['slug'] = Str::slug($validated['name']);

    Category::create($validated);

    return redirect()
        ->route('admin.categories')
        ->with('success', 'Catégorie ajoutée avec succès');
} 