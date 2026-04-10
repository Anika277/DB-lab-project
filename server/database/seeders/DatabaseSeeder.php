<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;
// Add this import at the top of the file
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Fiction', 'Non-Fiction', 'Mystery & Thriller',
            'Romance', 'Fantasy', 'Science Fiction',
            'Historical', 'Poetry', 'Self-Help & Wellness',
            'Travel & Adventure', 'Biography', "Children's Books",
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

        
  $books = [
    ['title' => 'Harry Potter and the Sorcerer Stone', 'author' => 'J.K. Rowling', 'cover_image' => 'https://books.google.com/books/content?id=wrOQLV6xB-wC&printsec=frontcover&img=1&zoom=1', 'category_id' => 5, 'description' => 'A young boy discovers he is a wizard on his eleventh birthday and begins his journey at Hogwarts School of Witchcraft and Wizardry.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Harry Potter and the Chamber of Secrets', 'author' => 'J.K. Rowling', 'cover_image' => 'https://books.google.com/books/content?id=5iTebBW_-XAC&printsec=frontcover&img=1&zoom=1', 'category_id' => 5, 'description' => 'Harry returns to Hogwarts for his second year, where a mysterious monster is petrifying students and a hidden chamber has been opened.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Atomic Habits', 'author' => 'James Clear', 'cover_image' => 'https://books.google.com/books/content?id=XfFvDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 9, 'description' => 'A proven framework for improving every day. James Clear reveals how tiny changes in behavior can lead to remarkable results.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Kite Runner', 'author' => 'Khaled Hosseini', 'cover_image' => 'https://books.google.com/books/content?id=CFteNgAACAAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 1, 'description' => 'A powerful story of friendship, betrayal, and redemption set against the backdrop of Afghanistan from the 1970s to the early 2000s.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Alchemist', 'author' => 'Paulo Coelho', 'cover_image' => 'https://books.google.com/books/content?id=FzVjBgAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 1, 'description' => 'A young Andalusian shepherd embarks on a journey to find treasure and discovers the true meaning of his destiny.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Dune', 'author' => 'Frank Herbert', 'cover_image' => 'https://books.google.com/books/content?id=B5UFEAAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 6, 'description' => 'Set in a distant future, a noble family battles for control of the desert planet Arrakis, the universe\'s only source of the most valuable substance.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'cover_image' => 'https://books.google.com/books/content?id=J4a6AAAAMAAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 4, 'description' => 'Elizabeth Bennet navigates issues of manners, upbringing, morality, education, and marriage in Georgian England.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => '1984', 'author' => 'George Orwell', 'cover_image' => 'https://books.google.com/books/content?id=kotPYEqx7kMC&printsec=frontcover&img=1&zoom=1', 'category_id' => 6, 'description' => 'In a totalitarian society, Winston Smith works for the government rewriting history and begins to question the regime.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Gone Girl', 'author' => 'Gillian Flynn', 'cover_image' => 'https://books.google.com/books/content?id=btkMMzEBuIAC&printsec=frontcover&img=1&zoom=1', 'category_id' => 3, 'description' => 'On their fifth wedding anniversary, Nick Dunne\'s wife Amy mysteriously disappears, and all evidence points to Nick.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'cover_image' => 'https://books.google.com/books/content?id=1EiJAwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 2, 'description' => 'A brief history of humankind, exploring how Homo sapiens came to dominate the Earth and shape our world.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien', 'cover_image' => 'https://books.google.com/books/content?id=pD6arNyKyi8C&printsec=frontcover&img=1&zoom=1', 'category_id' => 5, 'description' => 'Bilbo Baggins, a homebody hobbit, is swept into an epic quest to reclaim the dwarf homeland from a dragon.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Becoming', 'author' => 'Michelle Obama', 'cover_image' => 'https://books.google.com/books/content?id=4XFvDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 11, 'description' => 'The memoir of former First Lady Michelle Obama, chronicling her journey from Chicago\'s South Side to the White House.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Silent Patient', 'author' => 'Alex Michaelides', 'cover_image' => 'https://books.google.com/books/content?id=s9ZEDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 3, 'description' => 'A famous painter shoots her husband five times and then never speaks another word, leaving her therapist obsessed with uncovering her motive.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Book Thief', 'author' => 'Markus Zusak', 'cover_image' => 'https://books.google.com/books/content?id=mfNbH80ZRDMC&printsec=frontcover&img=1&zoom=1', 'category_id' => 1, 'description' => 'Narrated by Death, this is the story of Liesel Meminger, a young girl living with foster parents in Nazi Germany who steals books.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Midnight Library', 'author' => 'Matt Haig', 'cover_image' => 'https://books.google.com/books/content?id=vOXmDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 1, 'description' => 'Between life and death is a library with infinite books, each representing a different life Nora Seed could have lived.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Little Women', 'author' => 'Louisa May Alcott', 'cover_image' => 'https://books.google.com/books/content?id=R3NZAAAAYAAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 1, 'description' => 'The story of four sisters growing up during the American Civil War, following their journeys from childhood to womanhood.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'cover_image' => 'https://books.google.com/books/content?id=PGR2AwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 1, 'description' => 'Lawyer Atticus Finch defends a Black man accused of raping a white woman in the American South during the 1930s.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'cover_image' => 'https://books.google.com/books/content?id=iXn5U2IziiYC&printsec=frontcover&img=1&zoom=1', 'category_id' => 1, 'description' => 'A portrait of the Jazz Age through the eyes of narrator Nick Carraway and his mysterious neighbor Jay Gatsby.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'The Hunger Games', 'author' => 'Suzanne Collins', 'cover_image' => 'https://books.google.com/books/content?id=sazytgAACAAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 6, 'description' => 'In a dystopian future, teenager Katniss Everdeen volunteers to take her sister\'s place in a televised death match.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Brave New World', 'author' => 'Aldous Huxley', 'cover_image' => 'https://books.google.com/books/content?id=FeNbAAAAMAAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 6, 'description' => 'A futuristic society where humans are manufactured and conditioned for their social roles is disrupted by an outsider.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Circe', 'author' => 'Madeline Miller', 'cover_image' => 'https://books.google.com/books/content?id=XdZEDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 5, 'description' => 'The story of the legendary witch Circe, daughter of the sun god Helios, who discovers her powers and carves out her own destiny.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
    ['title' => 'Normal People', 'author' => 'Sally Rooney', 'cover_image' => 'https://books.google.com/books/content?id=s9hsDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 'category_id' => 4, 'description' => 'The complex relationship between Connell and Marianne as they navigate school, university, love and identity in modern Ireland.', 'pdf_url' => 'https://www.africau.edu/images/default/sample.pdf'],
];


        foreach ($books as $book) {
            Book::create(array_merge($book, ['available_copies' => 3]));
        }

    // Seed users FIRST
        DB::table('users')->insert([
            ['name' => 'Farin',      'email' => 'farin01@gmail.com',      'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mugdho',     'email' => 'mugdho02@gmail.com',     'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nahin',      'email' => 'nahin03@gmail.com',      'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apurbo',     'email' => 'apurbo01@gmail.com',     'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Akif',       'email' => 'akif05@gmail.com',       'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Auniruddho', 'email' => 'auniruddho06@gmail.com', 'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arpita',     'email' => 'arpita07@gmail.com',     'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shahadat',   'email' => 'shahadat08@gmail.com',   'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ratul',      'email' => 'ratul09@gmail.com',      'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pantha',     'email' => 'pantha10@gmail.com',     'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arko',       'email' => 'arka11@gmail.com',       'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arnab',      'email' => 'arnab12@gmail.com',      'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Taisha',     'email' => 'taisha13@gmail.com',     'password' => bcrypt('123456'), 'is_admin' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed event categories
        DB::table('event_categories')->insert([
            ['name' => 'Book Club',   'slug' => 'book-club',   'icon' => '📖', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Workshop',    'slug' => 'workshop',    'icon' => '✍️', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Author Talk', 'slug' => 'author-talk', 'icon' => '🎤', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kids',        'slug' => 'kids',        'icon' => '🧒', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed rooms
        DB::table('rooms')->insert([
            ['name' => 'Reading Room A', 'capacity' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Reading Room B', 'capacity' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Workshop Hall',  'capacity' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kids Corner',    'capacity' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Auditorium',     'capacity' => 50, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed events
        DB::table('events')->insert([
            ['title' => 'Book Club: The Midnight Library',  'description' => 'Join us for a cozy discussion of Matt Haig\'s heartwarming novel about second chances.', 'event_category_id' => 1, 'room_id' => 2, 'event_date' => '2026-04-15', 'event_time' => '18:00:00', 'max_seats' => 20, 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Creative Writing Workshop',        'description' => 'A hands-on workshop for aspiring writers. Bring a notebook and leave with the first page of your story.', 'event_category_id' => 2, 'room_id' => 3, 'event_date' => '2026-04-20', 'event_time' => '15:00:00', 'max_seats' => 15, 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Author Talk: Local Voices',        'description' => 'Meet three local authors as they share their journeys from first draft to published book.', 'event_category_id' => 3, 'room_id' => 5, 'event_date' => '2026-04-25', 'event_time' => '17:00:00', 'max_seats' => 50, 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Kids Storytime: Adventure Tales',  'description' => 'An interactive storytelling session for children aged 5-10. Costumes encouraged!', 'event_category_id' => 4, 'room_id' => 4, 'event_date' => '2026-04-18', 'event_time' => '10:00:00', 'max_seats' => 25, 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Book Club: Klara and the Sun',     'description' => 'Explore Kazuo Ishiguro\'s moving novel about artificial intelligence and what it means to be human.', 'event_category_id' => 1, 'room_id' => 2, 'event_date' => '2026-05-01', 'event_time' => '18:00:00', 'max_seats' => 20, 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed event registrations LAST
        $registrations = [];
        for ($i = 1; $i <= 13; $i++) {
            $registrations[] = ['user_id' => $i, 'event_id' => 1, 'status' => 'confirmed', 'registered_at' => now(), 'created_at' => now(), 'updated_at' => now()];
        }
        for ($i = 1; $i <= 12; $i++) {
            $registrations[] = ['user_id' => $i, 'event_id' => 2, 'status' => 'confirmed', 'registered_at' => now(), 'created_at' => now(), 'updated_at' => now()];
        }
        DB::table('event_registrations')->insert($registrations);
    }
}