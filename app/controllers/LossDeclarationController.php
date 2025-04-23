<?php

namespace Animal\Controllers;

use Animal\Models\Country;
use Animal\Models\PetOwner;
use Animal\Models\PetType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JetBrains\PhpStorm\NoReturn;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class LossDeclarationController
{
    public function create()
    {
        $countries = Country::all();
        $pet_types = PetType::all();

        //require VIEW_DIR.'/lossdeclaration/create.blade.php';
        View::make('lossdeclaration.create', compact('countries', 'pet_types'));
    }

    #[NoReturn]
    public function store(): void
    {
        check_csrf_token();

        $_SESSION['errors'] = null;
        $_SESSION['old'] = null;

        Validator::check([
            'email' => 'required|email',
            'vemail' => 'required|same:email',
            'phone' => 'phone',
            'country' => 'in_collection:countries',
        ]);

        PetOwner::upsert(
            [
            [
                'email' => $_REQUEST['email'],
                'phone' => $_REQUEST['phone'],
            ],
        ],
            uniqueBy: ['email'],
            update: ['phone']
        );

        $pet_owner = PetOwner::latest('updated_at')->first();

        Response::redirect('/loss-declaration?id='.$pet_owner->id);
    }

    public function show()
    {
        if (! isset($_GET['id']) || ! is_numeric($_GET['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }
        // Si vous êtes très très inquiet, mais le code avant fait les vérifications nécessaires
        $id = (int) trim($_GET['id']);

        try {
            $pet_owner = PetOwner::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Response::abort();
        }
        // Analyser la query string pour savoir quelle déclaration afficher
        require VIEW_DIR.'/lossdeclaration/show.blade.php';
    }
}
