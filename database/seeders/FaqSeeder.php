<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'question' => 'Comment puis-je ajouter un livre ?',
                'answer' => 'Cliquez sur "Ajouter un livre" dans le menu, remplissez le formulaire avec les informations du livre et téléchargez le fichier PDF.',
                'order' => 1
            ],
            [
                'question' => 'Quels formats de fichiers sont acceptés ?',
                'answer' => 'Actuellement, seul le format PDF est accepté pour garantir une compatibilité maximale.',
                'order' => 2
            ],
            [
                'question' => 'Y a-t-il une limite de taille pour les fichiers ?',
                'answer' => 'Oui, la taille maximale acceptée est de 10 MB par fichier.',
                'order' => 3
            ],
            [
                'question' => 'Comment fonctionne le système de likes ?',
                'answer' => 'Vous pouvez liker ou disliker un livre une seule fois. Le nombre total de likes est affiché sur la page du livre.',
                'order' => 4
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
} 