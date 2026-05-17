<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@dulich.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Users
        $users = [];
        $userNames = ['Nguyễn Văn An', 'Trần Thị Bình', 'Lê Hoàng Cường', 'Phạm Minh Duy', 'Hoàng Thu Hà'];
        foreach ($userNames as $i => $name) {
            $users[] = User::create([
                'name' => $name,
                'email' => 'user' . ($i + 1) . '@dulich.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }

        // Create Categories
        $categoriesData = [
            ['name' => 'Ẩm thực', 'description' => 'Khám phá ẩm thực đặc sắc các vùng miền'],
            ['name' => 'Điểm đến', 'description' => 'Giới thiệu các địa điểm du lịch hấp dẫn'],
            ['name' => 'Checkin', 'description' => 'Những địa điểm checkin sống ảo cực chất'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[] = Category::create($cat);
        }

        // Create Posts
        $postsData = [
            [
                'title' => 'Top 10 điểm đến không thể bỏ qua tại Đà Nẵng',
                'excerpt' => 'Khám phá 10 địa điểm du lịch tuyệt vời nhất tại thành phố đáng sống Đà Nẵng, từ Bà Nà Hills đến bãi biển Mỹ Khê.',
                'content' => '<h2>1. Bà Nà Hills - Cầu Vàng</h2>
<p>Bà Nà Hills nằm ở độ cao 1.487m so với mực nước biển, là điểm du lịch nổi tiếng nhất Đà Nẵng. Cầu Vàng với đôi bàn tay khổng lồ đã trở thành biểu tượng du lịch Việt Nam được cả thế giới biết đến.</p>
<h2>2. Bãi biển Mỹ Khê</h2>
<p>Được Forbes bình chọn là một trong 6 bãi biển quyến rũ nhất hành tinh, Mỹ Khê có bãi cát trắng mịn trải dài, nước biển trong xanh và sóng vừa phải rất thích hợp cho bơi lội.</p>
<h2>3. Ngũ Hành Sơn</h2>
<p>Quần thể 5 ngọn núi đá vôi nằm giữa lòng thành phố với nhiều hang động, chùa chiền cổ kính. Từ đỉnh núi bạn có thể phóng tầm mắt ngắm toàn cảnh Đà Nẵng.</p>
<h2>4. Bán đảo Sơn Trà</h2>
<p>Khu bảo tồn thiên nhiên với hệ sinh thái phong phú, là nơi sinh sống của loài voọc chà vá chân nâu quý hiếm. Đường lên Sơn Trà quanh co tuyệt đẹp, thích hợp cho chụp ảnh.</p>
<h2>5. Phố cổ Hội An</h2>
<p>Cách Đà Nẵng chỉ 30km, Hội An là di sản văn hóa thế giới với những con phố đèn lồng lung linh mỗi đêm rằm.</p>',
                'category_id' => 2, // Điểm đến
                'location' => 'Đà Nẵng',
                'image' => 'https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?w=800&q=80',
                'views_count' => 1250,
            ],
            [
                'title' => 'Hướng dẫn du lịch Phú Quốc tự túc 4 ngày 3 đêm',
                'excerpt' => 'Lịch trình chi tiết du lịch Phú Quốc 4N3Đ với chi phí tiết kiệm, bao gồm ăn uống, đi lại và các hoạt động vui chơi.',
                'content' => '<h2>Ngày 1: Khám phá Nam đảo</h2>
<p>Sáng đến Phú Quốc, nhận phòng khách sạn. Chiều tham quan Vinpearl Safari, tối dạo chợ đêm Phú Quốc thưởng thức hải sản tươi sống.</p>
<h2>Ngày 2: Tour 4 đảo</h2>
<p>Tham gia tour 4 đảo bằng cano: Hòn Thơm, Hòn Gầm Ghì, Hòn Bưởi, Hòn Mây Rút. Lặn ngắm san hô, câu cá giữa biển. Chi phí khoảng 250.000đ/người.</p>
<h2>Ngày 3: Bắc đảo</h2>
<p>Tham quan VinWonders, đi cáp treo vượt biển dài nhất thế giới 7.899m. Chiều ghé Mũi Gành Dầu, bãi Dài ngắm hoàng hôn.</p>
<h2>Ngày 4: Nghỉ ngơi và về</h2>
<p>Sáng tắm biển bãi Sao - bãi biển đẹp nhất Phú Quốc. Mua quà lưu niệm: nước mắm, tiêu Phú Quốc, trái sim.</p>
<h2>Chi phí ước tính</h2>
<p>Vé máy bay: 1.500.000đ - 2.500.000đ khứ hồi. Khách sạn: 400.000 - 800.000đ/đêm. Ăn uống: 200.000đ/ngày. Tổng: khoảng 4-6 triệu/người.</p>',
                'category_id' => 2, // Điểm đến
                'location' => 'Phú Quốc',
                'image' => 'https://images.unsplash.com/photo-1598090842581-c94b8e1e4bfb?w=800&q=80',
                'views_count' => 980,
            ],
            [
                'title' => 'Đặc sản Huế: 15 món ăn bạn nhất định phải thử',
                'excerpt' => 'Tổng hợp 15 món ăn đặc sản Huế nổi tiếng nhất, từ bún bò Huế đến bánh bèo, bánh nậm, com hến.',
                'content' => '<h2>1. Bún bò Huế</h2>
<p>Món ăn biểu tượng của Huế với nước dùng đậm đà từ xương heo, bò, sả và mắm ruốc. Ăn kèm với rau sống, giá đỗ và ớt tươi.</p>
<h2>2. Bánh bèo</h2>
<p>Bánh làm từ bột gạo hấp trong chén nhỏ, rắc tôm chấy và hành phi giòn. Ăn kèm nước mắm pha chua ngọt.</p>
<h2>3. Cơm hến</h2>
<p>Cơm nguội trộn với hến xào, rau thơm, đậu phộng rang, bánh tráng nướng vụn. Vị cay nồng đặc trưng xứ Huế.</p>
<h2>4. Bánh khoái</h2>
<p>Giống bánh xèo nhưng nhỏ hơn, giòn rụm, nhân tôm thịt. Cuốn với rau sống, chấm nước lèo đặc biệt.</p>
<h2>5. Chè Huế</h2>
<p>Huế nổi tiếng với hàng chục loại chè: chè bột lọc, chè đậu xanh đánh, chè hạt sen, chè trôi nước.</p>',
                'category_id' => 1, // Ẩm thực
                'location' => 'Huế',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80',
                'views_count' => 756,
            ],
            [
                'title' => 'Review top 5 homestay đẹp nhất Đà Lạt 2024',
                'excerpt' => 'Review chi tiết 5 homestay view đẹp, giá hợp lý tại Đà Lạt dành cho các cặp đôi và nhóm bạn.',
                'content' => '<h2>1. The Kupid Homestay</h2>
<p>Nằm trên đồi thông, view hồ Tuyền Lâm tuyệt đẹp. Phòng thiết kế theo phong cách Bắc Âu ấm cúng. Giá: 500.000 - 800.000đ/đêm.</p>
<h2>2. La Maison De Dalat</h2>
<p>Biệt thự cổ Pháp giữa vườn hoa rực rỡ. Không gian lãng mạn, thích hợp cho các cặp đôi. Giá: 600.000 - 1.200.000đ/đêm.</p>
<h2>3. Tigon Premium Hotel</h2>
<p>View toàn cảnh thành phố từ tầng thượng. Phòng hiện đại, có bể bơi ngoài trời. Giá: 700.000 - 1.500.000đ/đêm.</p>
<h2>4. Zen Valley Dalat</h2>
<p>Nằm trong thung lũng yên tĩnh, bao quanh bởi rừng thông. Phong cách Nhật Bản tối giản. Giá: 400.000 - 700.000đ/đêm.</p>',
                'category_id' => 3, // Checkin
                'location' => 'Đà Lạt',
                'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&q=80',
                'views_count' => 623,
            ],
            [
                'title' => '10 mẹo tiết kiệm chi phí khi đi du lịch',
                'excerpt' => 'Bí kíp du lịch tiết kiệm nhưng vẫn trải nghiệm đầy đủ, từ đặt vé máy bay rẻ đến chọn chỗ ăn ngon giá tốt.',
                'content' => '<h2>1. Đặt vé máy bay trước 2-3 tháng</h2>
<p>Giá vé rẻ nhất thường vào thứ 3, thứ 4 hàng tuần. Đặt trước càng sớm càng có giá tốt. Theo dõi các hãng giá rẻ như Vietjet, Bamboo Airways.</p>
<h2>2. Đi vào mùa thấp điểm</h2>
<p>Tránh lễ tết, mùa hè. Đi vào các tháng 3-4, 9-10 sẽ được giá phòng rẻ hơn 30-50%.</p>
<h2>3. Ở homestay hoặc hostel</h2>
<p>Tiết kiệm 50-70% chi phí so với khách sạn. Nhiều homestay còn có bếp để tự nấu ăn.</p>
<h2>4. Ăn ở quán địa phương</h2>
<p>Hỏi người dân địa phương để tìm quán ăn ngon, rẻ. Tránh các nhà hàng gần khu du lịch vì giá thường đắt gấp 2-3 lần.</p>
<h2>5. Sử dụng phương tiện công cộng</h2>
<p>Xe buýt, grab bike rẻ hơn nhiều so với taxi. Ở các thành phố lớn nên đi xe buýt hoặc thuê xe máy.</p>',
                'category_id' => 2, // Điểm đến
                'location' => 'Việt Nam',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
                'views_count' => 1432,
            ],
            [
                'title' => 'Khám phá Sapa mùa lúa chín - Khi nào đi đẹp nhất?',
                'excerpt' => 'Hướng dẫn thời điểm lý tưởng ngắm ruộng bậc thang mùa lúa chín vàng ở Sapa và lịch trình 3 ngày 2 đêm.',
                'content' => '<h2>Thời điểm đẹp nhất</h2>
<p>Mùa lúa chín ở Sapa rơi vào khoảng tháng 9 - tháng 10 hàng năm. Lúc này, những thửa ruộng bậc thang chuyển sang màu vàng óng ả, tạo nên bức tranh thiên nhiên tuyệt đẹp.</p>
<h2>Ngày 1: Đến Sapa</h2>
<p>Từ Hà Nội đi xe khách hoặc tàu hỏa lên Sapa. Check-in khách sạn, chiều đi bộ khám phá thị trấn, ngắm nhà thờ đá, chợ đêm.</p>
<h2>Ngày 2: Trekking</h2>
<p>Trek từ Sapa qua bản Cát Cát, Lao Chải, Tả Van. Ngắm ruộng bậc thang, giao lưu với người H\'Mông, thưởng thức thắng cố.</p>
<h2>Ngày 3: Fansipan</h2>
<p>Đi cáp treo lên đỉnh Fansipan - nóc nhà Đông Dương 3.143m. Ngắm biển mây, check-in cổng trời.</p>',
                'category_id' => 3, // Checkin
                'location' => 'Sapa, Lào Cai',
                'image' => 'https://images.unsplash.com/photo-1528127269322-539801943592?w=800&q=80',
                'views_count' => 875,
            ],
            [
                'title' => 'Ẩm thực đường phố Sài Gòn: Những quán ăn vỉa hè ngon nhất',
                'excerpt' => 'Tổng hợp những quán ăn vỉa hè nổi tiếng nhất Sài Gòn mà bất kỳ food tour nào cũng phải ghé.',
                'content' => '<h2>1. Phở Hòa Pasteur</h2>
<p>Quán phở nổi tiếng nhất Sài Gòn, hoạt động từ năm 1968. Nước dùng trong, ngọt tự nhiên. Địa chỉ: 260C Pasteur, Q3.</p>
<h2>2. Bánh mì Huỳnh Hoa</h2>
<p>Ổ bánh mì đầy ắp nhân thịt nguội, pate, bơ. Xếp hàng cả tiếng nhưng vẫn đông nghịt. Giá 55.000đ/ổ.</p>
<h2>3. Cơm tấm Bụi</h2>
<p>Cơm tấm sườn bì chả với nước mắm pha đặc trưng Sài Gòn. Sườn nướng than hoa thơm lừng.</p>
<h2>4. Bún thịt nướng Nguyễn Tri Phương</h2>
<p>Bún thịt nướng kèm chả giò, rau sống tươi mát. Nước mắm chua ngọt vừa miệng. Quán nhỏ nhưng lúc nào cũng đông.</p>',
                'category_id' => 1, // Ẩm thực
                'location' => 'TP. Hồ Chí Minh',
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80',
                'views_count' => 1100,
            ],
            [
                'title' => 'Cẩm nang du lịch Hạ Long: Tất cả những gì bạn cần biết',
                'excerpt' => 'Hướng dẫn du lịch Hạ Long chi tiết từ A-Z, bao gồm cách đi, chỗ ở, ăn gì, chơi gì, chi phí bao nhiêu.',
                'content' => '<h2>Di chuyển đến Hạ Long</h2>
<p>Từ Hà Nội có thể đi xe khách (4h, 120.000đ) hoặc xe limousine (3.5h, 250.000đ). Sân bay Vân Đồn cách Hạ Long 50km.</p>
<h2>Nơi lưu trú</h2>
<p>Khách sạn 3 sao: 400.000 - 600.000đ/đêm. Du thuyền ngủ đêm trên vịnh: 1.500.000 - 5.000.000đ/người.</p>
<h2>Các hoạt động</h2>
<p>Du thuyền ngắm vịnh, chèo kayak, tham quan hang Sửng Sốt, đảo Ti Tốp, làng chài Cửa Vạn, bơi lội, lặn biển.</p>
<h2>Ẩm thực</h2>
<p>Hải sản tươi sống tại chợ Hạ Long, chả mực, bánh cuốn chả mực, sá sùng, sam biển.</p>',
                'category_id' => 2, // Điểm đến
                'location' => 'Hạ Long, Quảng Ninh',
                'image' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=800&q=80',
                'views_count' => 920,
            ],
            [
                'title' => 'Kinh nghiệm leo Tà Năng - Phan Dũng: Cung đường trekking đẹp nhất Việt Nam',
                'excerpt' => 'Chia sẻ kinh nghiệm chinh phục cung trekking Tà Năng - Phan Dũng, lưu ý an toàn và chuẩn bị hành lý.',
                'content' => '<h2>Giới thiệu cung đường</h2>
<p>Tà Năng - Phan Dũng dài khoảng 55km, đi qua 3 tỉnh Lâm Đồng, Ninh Thuận, Bình Thuận. Được mệnh danh là cung đường trekking đẹp nhất Việt Nam với đồi cỏ, suối, rừng thông.</p>
<h2>Chuẩn bị</h2>
<p>Giày trekking bám tốt, ba lô 40-50L, đèn pin, áo mưa, nước uống 3-4L, lương khô, thuốc cá nhân, võng hoặc lều.</p>
<h2>Lưu ý an toàn</h2>
<p>LUÔN đi theo nhóm và thuê porter/guide. Không đi một mình. Kiểm tra thời tiết trước khi đi. Tránh mùa mưa (tháng 6-9).</p>
<h2>Lịch trình 3 ngày</h2>
<p>Ngày 1: Đi từ Tà Năng qua đồi cỏ, hạ trại ven suối. Ngày 2: Vượt qua rừng, suối, dốc cao, ngủ ở bãi Tà Năng. Ngày 3: Hoàn thành hành trình tại Phan Dũng.</p>',
                'category_id' => 3, // Checkin
                'location' => 'Lâm Đồng - Bình Thuận',
                'image' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800&q=80',
                'views_count' => 670,
            ],
            [
                'title' => 'Ninh Bình - Tràng An: Di sản thiên nhiên thế giới',
                'excerpt' => 'Khám phá vẻ đẹp kỳ vĩ của Tràng An, Tam Cốc và các điểm du lịch hấp dẫn tại Ninh Bình.',
                'content' => '<h2>Tràng An</h2>
<p>Quần thể danh thắng Tràng An được UNESCO công nhận là Di sản Văn hóa và Thiên nhiên thế giới. Đi thuyền qua 12 hang động, ngắm cảnh núi non hùng vĩ.</p>
<h2>Tam Cốc - Bích Động</h2>
<p>Được mệnh danh là "Hạ Long trên cạn", Tam Cốc đẹp nhất vào mùa lúa chín tháng 5-6. Ngồi thuyền trên sông Ngô Đồng, qua 3 hang động tự nhiên.</p>
<h2>Chùa Bái Đính</h2>
<p>Quần thể chùa lớn nhất Đông Nam Á với nhiều kỷ lục: tượng Phật bằng đồng lớn nhất, hành lang La Hán dài nhất.</p>
<h2>Hang Múa</h2>
<p>Leo 500 bậc đá lên đỉnh Hang Múa, ngắm toàn cảnh Tam Cốc từ trên cao. Đặc biệt đẹp lúc hoàng hôn.</p>',
                'category_id' => 2, // Điểm đến
                'location' => 'Ninh Bình',
                'image' => 'https://images.unsplash.com/photo-1582298627725-d91ab2dcc2c8?w=800&q=80',
                'views_count' => 810,
            ],
        ];

        foreach ($postsData as $postData) {
            $post = new Post();
            $post->user_id = $admin->id;
            $post->category_id = $postData['category_id'];
            $post->title = $postData['title'];
            $post->slug = Str::slug($postData['title']) . '-' . Str::random(5);
            $post->excerpt = $postData['excerpt'];
            $post->content = $postData['content'];
            $post->image = $postData['image'] ?? null;
            $post->location = $postData['location'];
            $post->views_count = $postData['views_count'];
            $post->status = 'published';
            $post->save();
        }

        // Create Comments
        $posts = Post::all();
        $allUsers = array_merge([$admin], $users);
        $commentTexts = [
            'Bài viết rất hay và chi tiết! Cảm ơn tác giả.',
            'Mình đã đi rồi, đúng như bài viết mô tả luôn!',
            'Cảm ơn chia sẻ, mình sẽ tham khảo cho chuyến đi sắp tới.',
            'Rất hữu ích, bookmark lại để đọc sau.',
            'Có ai đi cùng tháng 12 không ạ?',
            'Tuyệt vời quá! Phong cảnh đẹp mê hồn.',
            'Mình thích phần review homestay, rất thực tế.',
            'Chi phí hợp lý phết, mình sẽ thử dịp Tết.',
        ];

        foreach ($posts as $post) {
            $numComments = rand(2, 5);
            for ($i = 0; $i < $numComments; $i++) {
                Comment::create([
                    'user_id' => $allUsers[array_rand($allUsers)]->id,
                    'post_id' => $post->id,
                    'content' => $commentTexts[array_rand($commentTexts)],
                    'is_approved' => rand(0, 10) > 2, // 80% approved
                ]);
            }
        }

        // Create some favorites
        foreach ($users as $user) {
            $favPosts = $posts->random(rand(2, 5));
            foreach ($favPosts as $post) {
                $user->favoritePosts()->syncWithoutDetaching([$post->id]);
            }
        }

        // Create ratings
        foreach ($users as $user) {
            $ratedPosts = $posts->random(rand(3, 6));
            foreach ($ratedPosts as $post) {
                \App\Models\Rating::updateOrCreate(
                    ['user_id' => $user->id, 'post_id' => $post->id],
                    ['score' => rand(3, 5)]
                );
            }
        }
    }
}
