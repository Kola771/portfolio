<?php

namespace App\Http\Controllers;

use App\Events\FlashMessageEvent;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $allProject = Project::orderBy('created_at', 'desc')
        ->get()
        ->transform(fn($project) => [
            "id" => Crypt::encryptString($project->id),
            "name_project" => $project->name_project,
            "description" => $project->description,
            "image" => $project->image,
            "poste" => $project->poste,
            "frontend" => $project->frontend,
            "backend" => $project->backend,
            "linkSite" => $project->linkSite,
            "created_at" => $project->created_at,
        ]);
        return Inertia::render('Projects', ["allProject" => $allProject]);
        // Logique pour afficher une liste par exemple
    }

    public function addVue()
    {
        return Inertia::render('Admin/CreateProject', []);
    }

    public function searchProject(Request $request)
    {
        $searchProject = Project::orderBy('created_at', 'desc')
        ->where('name_project', 'like', '%' . $request->value . '%')
        ->get()
        ->transform(fn($project) => [
            "id" => Crypt::encryptString($project->id),
            "name_project" => $project->name_project,
            "image" => $project->image,
            "poste" => $project->poste,
            "created_at" => $project->created_at,
        ]);

        return json_encode($searchProject);
    }

    public function allProject()
    {
        $allProject = Project::orderBy('created_at', 'desc')
        ->get()
        ->transform(fn($project) => [
            "id" => Crypt::encryptString($project->id),
            "name_project" => $project->name_project,
            "description" => $project->description,
            "image" => $project->image,
            "poste" => $project->poste,
            "frontend" => $project->frontend,
            "backend" => $project->backend,
            "linkSite" => $project->linkSite,
            "created_at" => $project->created_at,
        ]);

        return json_encode($allProject);
    }

    // Récupération des trois derniers projets
    public function allProjectLimit()
    {
        $allProject = Project::orderBy('created_at', 'desc')
        ->limit(3)
        ->get()
        ->transform(fn($project) => [
            "id" => Crypt::encryptString($project->id),
            "name_project" => $project->name_project,
            "description" => $project->description,
            "image" => $project->image,
            "poste" => $project->poste,
            "frontend" => $project->frontend,
            "backend" => $project->backend,
            "linkSite" => $project->linkSite,
            "created_at" => $project->created_at,
        ]);

        return json_encode($allProject);
    }

    public function show($id)
    {
        // Logique pour afficher un élément spécifique
    }

    public function create()
    {
        // Logique pour afficher le formulaire de création
    }

    public function store(Request $request)
    {
        $projet = $_POST["projet"];
        $description = $_POST["description"];
        $poste = $_POST["poste"];
        $url = $_POST["url"];
        $frontend = $_POST["frontend"];
        $backend = $_POST["backend"];

        $verify = Project::where("name_project", $projet)->get()->toArray();
        if (count($verify) == 0) {
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
                        $nouveauNom = uniqid("projet-", true);
                        $file = $nouveauNom . "." . $extensionImage;
                        $location = base_path() . "/storage/app/public/projetImage/" . $file;
                        move_uploaded_file($tmp_name, $location);

                        try {
                            // insertion des données dans la tables projects
                            Project::create([
                                'name_project' => $projet,
                                'image' => $file,
                                'description' => $description,
                                'poste' => $poste,
                                'frontend' => $frontend,
                                'backend' => $backend,
                                'linkSite' => $url,
                            ]);
                            return json_encode(["result" => "Insertion réussie !!!"]);
                        } catch (\Throwable $th) {
                            $msg = "Une erreur s'est produite lors de la sauvegarde du projet !";
                            return response()->json(['error' => $msg]);
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
            return json_encode(["error" => "Un projet portant ce nom existe déjà dans la base de données !!!"]);
        }
    }

    public function edit(Project $project, $id)
    {
        try {
            $id = Crypt::decryptString($id);
            $oneProject = $project->findOrFail($id);
            $oneProject = [
                "id" => Crypt::encryptString($oneProject->id),
                "name_project" => $oneProject->name_project,
                "image" => $oneProject->image,
                "poste" => $oneProject->poste,
                "description" => $oneProject->description,
                "frontend" => $oneProject->frontend,
                "backend" => $oneProject->backend,
                "linkSite" => $oneProject->linkSite,
            ];
        } catch (\Throwable $th) {
            $errorMsg = "Erreur survenue lors du décryptage de la clé !";
            $event = new FlashMessageEvent($errorMsg);
            event($event);
            session()->flash('error', $errorMsg);
        }
        return Inertia::render('Admin/EditProject', ["oneProject" => $oneProject]);
    }

    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decryptString($id);
            $projet = $_POST["projet"];
            $description = $_POST["description"];
            $poste = $_POST["poste"];
            $url = $_POST["url"];
            $frontend = $_POST["frontend"];
            $backend = $_POST["backend"];
            $result = Project::where("id", $id)->get()->toArray()[0];
            $verify = Project::where("name_project", $projet)->get()->toArray();

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
                            $nouveauNom = uniqid("projet-", true);
                            $file = $nouveauNom . "." . $extensionImage;
                            $location = base_path() . "/storage/app/public/projetImage/" . $file;
                            move_uploaded_file($tmp_name, $location);
                            // Ici on supprime l'ancienne image du projet
                            $cheminSupFile = base_path() . "/storage/app/public/projetImage/" . $result["image"];
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

            // Je vérifie si le nouveau nom entré par l'utilisateur existe déjà
            if (count($verify) > 0) {
                if ($result["id"] === $verify[0]["id"]) {
                    try {
                        // insertion des données dans la tables projects
                        Project::where("id", "=", $id)->update([
                            'name_project' => $projet,
                            'image' => $file,
                            'description' => $description,
                            'poste' => $poste,
                            'frontend' => $frontend,
                            'backend' => $backend,
                            'linkSite' => $url,
                        ]);
                        return json_encode(["result" => "Modification réussie !!!"]);
                    } catch (\Throwable $th) {
                        $msg = "Une erreur s'est produite lors de la modification du projet !";
                        return response()->json(['error' => $msg]);
                    }
                } else {
                    return json_encode(["error" => "Un projet portant ce nom existe déjà !!!"]);
                }
            } else {
                try {
                    // insertion des données dans la tables projects
                    Project::where("id", "=", $id)->update([
                        'name_project' => $projet,
                        'image' => $file,
                        'description' => $description,
                        'poste' => $poste,
                        'frontend' => $frontend,
                        'backend' => $backend,
                        'linkSite' => $url,
                    ]);
                    return json_encode(["result" => "Modification réussie !!!"]);
                } catch (\Throwable $th) {
                    $msg = "Une erreur s'est produite lors de la modification du projet !";
                    return response()->json(['error' => $msg]);
                }
            }
        } catch (\Throwable $th) {
            $errorMsg = "Erreur survenue lors du décryptage de la clé !";
            $event = new FlashMessageEvent($errorMsg);
            event($event);
            session()->flash('error', $errorMsg);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->id);
            Project::destroy($id);
            $allProject = Project::orderBy('created_at', 'desc')
            ->get()
            ->transform(fn($project) => [
                "id" => Crypt::encryptString($project->id),
                "name_project" => $project->name_project,
                "image" => $project->image,
                "poste" => $project->poste,
                "created_at" => $project->created_at,
            ]);
            return json_encode(["result"=> "Suppression réussie !!!", "allProject" => $allProject]);
        } catch (\Throwable $th) {
            return json_encode(["error" => "Erreur dans la suppression !!!"]);
        }
    }
}