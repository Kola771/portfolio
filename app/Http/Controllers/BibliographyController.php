<?php

namespace App\Http\Controllers;

use App\Events\FlashMessageEvent;
use App\Models\Bibliography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class BibliographyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bibligraphies = Bibliography::all()
            ->transform(fn($bilbiograph) => [
                "id" => Crypt::encryptString($bilbiograph->id),
                "bibliographie" => $bilbiograph->bibliographie,
                "image" => $bilbiograph->image,
            ]);
            if(count($bibligraphies) > 0)
            {
                $myBibliography = $bibligraphies[0];
                return Inertia::render("Admin/Bibliography/Index", ["personnality" => $myBibliography]);
            }
    }

    // Récupération de la bibliographie
    public function bibliography()
    {
        $bibligraphies = Bibliography::all()
            ->transform(fn($bilbiograph) => [
                "id" => Crypt::encryptString($bilbiograph->id),
                "bibliographie" => $bilbiograph->bibliographie,
                "image" => $bilbiograph->image,
            ]);
        $myBibliography = $bibligraphies[0];
        return json_encode($myBibliography);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bibliography $bibliography)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bibliography $bibliography)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $bibliographie = nl2br($_POST["bibliographie"]);
            $result = Bibliography::where("id", $id)->get()->toArray()[0];

            $file = "";
            // Je vérifie si l'utilsateur a choisi une image
            if (isset($_FILES["fichier"])) {
                $name = $_FILES["fichier"]["name"];
                $tmp_name = $_FILES["fichier"]["tmp_name"];
                $size = $_FILES["fichier"]["size"];
                $error = $_FILES["fichier"]["error"];
                $maximal = 10000000;

                $tableauExtension = ["jpg", "jpeg", "png"];

                $extensionImage = pathinfo($name, PATHINFO_EXTENSION);

                if (in_array($extensionImage, $tableauExtension)) {
                    if ($size <= $maximal) {
                        if ($error == 0) {
                            $nouveauNom = uniqid("bibliographie-", true);
                            $file = $nouveauNom . "." . $extensionImage;
                            $location = base_path() . "/storage/app/public/myassets/" . $file;
                            move_uploaded_file($tmp_name, $location);
                            // Ici on supprime l'ancienne image du projet
                            $cheminSupFile = base_path() . "/storage/app/public/myassets/" . $result["image"];
                            if (isset($cheminSupFile)) {
                                unlink($cheminSupFile);
                            }
                        } else {
                            return json_encode(["error" => "L'image ne peut être prise en charge !!!"]);
                        }
                    } else {
                        return json_encode(["error" => "La taille de cette image dépasse la taille maximale que nous validons (10Mo) !!!"]);
                    }
                } else {
                    return json_encode(["error" => "L'extension de cette image ne figue dans la liste d'extension que nous acceptons !!!"]);
                }
            } else {
                $file = $result["image"];
            }

            try {
                // insertion des données dans la tables projects
                Bibliography::where("id", "=", $id)->update([
                    'bibliographie' => $bibliographie,
                    'image' => $file,
                ]);
                return json_encode(["result" => "Modification réussie !!!"]);
            } catch (\Throwable $th) {
                $msg = "Une erreur s'est produite lors de la modification de votre bibliographie !";
                return response()->json(['error' => $msg]);
            }
        } catch (\Throwable $th) {
            $errorMsg = "Erreur survenue lors du décryptage de la clé !";
            $event = new FlashMessageEvent($errorMsg);
            event($event);
            session()->flash('error', $errorMsg);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bibliography $bibliography)
    {
        //
    }
}