<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\User;
use Carbon\Carbon;


class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();

        $movies = [
            ['The Shawshank Redemption', 'Two prisoners bond over years, finding hope in a hopeless place.'],
            ['The Godfather', 'A mafia patriarch transfers control to his reluctant son.'],
            ['The Dark Knight', 'Batman faces the chaos of the Joker in Gotham City.'],
            ['Pulp Fiction', 'Interconnected stories of crime, redemption, and violence.'],
            ['Forrest Gump', 'A simple man witnesses and shapes historical events.'],
            ['Fight Club', 'An office worker creates a secret fight club.'],
            ['Inception', 'A thief steals secrets through dream manipulation.'],
            ['The Matrix', 'A hacker learns the truth about reality.'],
            ['Gladiator', 'A betrayed general seeks revenge in the arena.'],
            ['Interstellar', 'Astronauts search for a new home for humanity.'],
            ['The Lord of the Rings: The Fellowship of the Ring', 'A hobbit begins his journey to destroy a powerful ring.'],
            ['The Lord of the Rings: The Two Towers', 'The fellowship is divided but continues the mission.'],
            ['The Lord of the Rings: The Return of the King', 'The final battle for Middle-earth begins.'],
            ['The Silence of the Lambs', 'A young FBI agent seeks help from a cannibal to catch a killer.'],
            ['Saving Private Ryan', 'Soldiers search for a missing paratrooper in WWII.'],
            ['Schindler’s List', 'A businessman saves hundreds of Jews during the Holocaust.'],
            ['Se7en', 'Two detectives hunt a killer using the seven deadly sins.'],
            ['The Green Mile', 'A death row guard encounters a man with healing powers.'],
            ['Goodfellas', 'A young man rises through the ranks of the mob.'],
            ['Braveheart', 'A Scottish warrior leads a rebellion against England.'],
            ['The Departed', 'An undercover cop and mole try to find each other.'],
            ['Whiplash', 'A drummer pushes his limits under a brutal instructor.'],
            ['The Prestige', 'Two rival magicians obsess over their secrets.'],
            ['Memento', 'A man with short-term memory loss seeks revenge.'],
            ['Django Unchained', 'A freed slave sets out to rescue his wife.'],
            ['12 Angry Men', 'Jurors debate the guilt of a young defendant.'],
            ['The Social Network', 'The rise of Facebook and its founder.'],
            ['No Country for Old Men', 'A hunter finds stolen money and is pursued.'],
            ['Requiem for a Dream', 'Addiction ruins the lives of four people.'],
            ['The Pianist', 'A Jewish pianist struggles to survive in WWII Warsaw.'],
            ['A Beautiful Mind', 'A brilliant mathematician struggles with schizophrenia.'],
            ['La La Land', 'An aspiring actress and musician fall in love.'],
            ['The Revenant', 'A frontiersman survives a bear attack and seeks revenge.'],
            ['Black Swan', 'A ballerina descends into madness.'],
            ['The Wolf of Wall Street', 'A stockbroker rises and falls in excess.'],
            ['Mad Max: Fury Road', 'In a desert wasteland, a woman rebels against a tyrant.'],
            ['Her', 'A man falls in love with an AI assistant.'],
            ['Parasite', 'A poor family infiltrates a rich household.'],
            ['Joker', 'A troubled man turns to violence and becomes a symbol.'],
            ['Logan', 'An aging Wolverine protects a young mutant.'],
            ['Blade Runner 2049', 'A replicant uncovers a hidden truth.'],
            ['The Imitation Game', 'Alan Turing cracks Nazi codes during WWII.'],
            ['The Grand Budapest Hotel', 'A concierge and his protégé get caught in a mystery.'],
            ['Arrival', 'A linguist works to communicate with aliens.'],
            ['The Truman Show', 'A man realizes his life is a TV show.'],
            ['Prisoners', 'A father searches for his missing daughter.'],
            ['Gone Girl', 'A man becomes the suspect when his wife vanishes.'],
            ['The Big Short', 'Investors predict and profit from the 2008 crash.'],
            ['Bohemian Rhapsody', 'The story of Freddie Mercury and Queen.'],
            ['1917', 'Two soldiers cross enemy lines to deliver a message.']
        ];


         foreach ($movies as [$title, $description]) {
            Movie::create([
                'title' => $title,
                'description' => $description,
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now()->subDays(rand(1, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
