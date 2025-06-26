<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ImagenesController extends Controller
{
	public function upload(Request $request)
	{
		$request->validate([
			'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);

		if ($request->file('imagen')->isValid()) {
			$imageName = time() . '.' . $request->imagen->extension();
			$request->imagen->move(public_path('img'), $imageName);

			return back()->with('success', 'Imagen subida con éxito.')->with('imagen', $imageName);
		}

		return back()->withErrors('Error al subir la imagen.');
	}
}