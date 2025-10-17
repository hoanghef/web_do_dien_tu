<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_name' => 'CPU Intel Core i5-12400F',
            'orientation' => 'Bộ vi xử lý Intel Core i5-12400F hiệu năng cao, phù hợp cho game và làm việc.',
            'description' => 'Intel Core i5-12400F có 6 nhân 12 luồng, xung nhịp tối đa 4.4GHz, hỗ trợ DDR4/DDR5. CPU này mang lại hiệu năng ổn định cho gaming và công việc văn phòng, tiết kiệm điện năng, không tích hợp GPU.',
            'price' => 4200000,
            'stock' => 40,
            'discount' => 5,
            'image' => 'product/shopping (1).webp',
            'category_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Mainboard ASUS B660M-A D4',
            'orientation' => 'Bo mạch chủ ASUS B660M-A D4 hỗ trợ CPU Intel thế hệ 12, thiết kế chắc chắn, nhiều cổng kết nối.',
            'description' => 'Mainboard ASUS B660M-A D4 có socket LGA1700, hỗ trợ RAM DDR4, PCIe 4.0, M.2 NVMe, cổng USB 3.2 Gen 2. Thiết kế tản nhiệt VRM tốt, đảm bảo hiệu suất ổn định lâu dài.',
            'price' => 3200000,
            'stock' => 30,
            'discount' => 0,
            'image' => 'product/download.jpeg',
            'category_id' => 3,
        ]);

        Product::create([
            'product_name' => 'RAM Corsair Vengeance LPX 16GB (2x8GB) DDR4 3200MHz',
            'orientation' => 'RAM hiệu năng cao cho PC gaming và làm việc, độ bền và tốc độ vượt trội.',
            'description' => 'Corsair Vengeance LPX 16GB DDR4 3200MHz gồm 2 thanh 8GB, tản nhiệt nhôm hiệu quả, tương thích với nhiều mainboard. Giúp hệ thống hoạt động mượt mà trong đa nhiệm và chơi game.',
            'price' => 1300000,
            'stock' => 50,
            'discount' => 10,
            'image' => 'product/1.jpg',
            'category_id' => 2,
        ]);

        Product::create([
            'product_name' => 'SSD Samsung 980 500GB NVMe M.2',
            'orientation' => 'Ổ cứng SSD tốc độ cao chuẩn NVMe, giúp khởi động máy và ứng dụng nhanh.',
            'description' => 'Samsung 980 500GB NVMe sử dụng PCIe 3.0, tốc độ đọc đến 3500MB/s. Thiết kế nhỏ gọn, bền bỉ, lý tưởng cho game thủ và dân đồ họa.',
            'price' => 1550000,
            'stock' => 60,
            'discount' => 0,
            'image' => 'product/download (1).jpeg',
            'category_id' => 5,
        ]);

        Product::create([
            'product_name' => 'Card đồ họa MSI RTX 3060 Ventus 2X 12G',
            'orientation' => 'Card đồ họa RTX 3060 mạnh mẽ cho game và đồ họa chuyên nghiệp.',
            'description' => 'MSI RTX 3060 Ventus 2X 12G sử dụng kiến trúc Ampere, 12GB GDDR6, hỗ trợ Ray Tracing và DLSS. Hiệu năng cao, tản nhiệt kép, hoạt động êm ái, ổn định.',
            'price' => 8900000,
            'stock' => 25,
            'discount' => 5,
            'image' => 'product/vga-msi-geforce-rtx-3060-ventus-2x-12g-oc_.webp',
            'category_id' => 4,
        ]);

        Product::create([
            'product_name' => 'Vỏ Case Antec C8 Wood (EATX, USB Type C, Mặt Gỗ)',
            'orientation' => 'Case Full Tower với mặt kính kỹ thuật vát 45°, thiết kế độc đáo, chất liệu thép và nhựa cao cấp.',
            'description' => 'Case Antec C8 Wood hỗ trợ EATX, trang bị USB Type C, hệ thống làm mát tối ưu. Phù hợp cho các cấu hình PC cao cấp.',
            'price' => 1200000,
            'stock' => 40,
            'discount' => 10,
            'image' => 'product/49296_v____case_antec_c8_wood__1_.jpg',
            'category_id' => 7,
        ]);

        Product::create([
            'product_name' => 'Nguồn Máy Tính Corsair CX650 650W 80 Plus Bronze',
            'orientation' => 'Nguồn máy tính 650W, đạt chuẩn 80 Plus Bronze, cung cấp điện ổn định và tiết kiệm điện.',
            'description' => 'Nguồn Corsair CX650 với công suất thực 650W, quạt 120mm hoạt động êm, dây bọc lưới, bảo vệ linh kiện an toàn.',
            'price' => 1399999,
            'stock' => 100,
            'discount' => 10,
            'image' => 'product/47607_corsair_cx650_650w_80_plus_bronze_cp_.jpg',
            'category_id' => 6,
        ]);

        Product::create([
            'product_name' => 'Tản nhiệt CPU JONSBO RGB CR-1000 EVO BLACK',
            'orientation' => 'Tản nhiệt khí nhỏ gọn, hiệu quả, với hiệu ứng RGB đẹp mắt.',
            'description' => 'JONSBO CR-1000 EVO Black kích thước 120mm, dễ lắp đặt, làm mát tốt cho CPU phổ thông và gaming.',
            'price' => 399999,
            'stock' => 50,
            'discount' => 10,
            'image' => 'product/text_ng_n_25__7_26.webp',
            'category_id' => 8,
        ]);

        Product::create([
            'product_name' => 'Giá treo màn hình HyperWork P1 Dual 22-34 inch',
            'orientation' => 'Giá treo màn hình đôi điều chỉnh kháng lực, phù hợp màn hình 22-34 inch.',
            'description' => 'HyperWork P1 Dual dễ dàng điều chỉnh vị trí màn hình, giúp tối ưu không gian làm việc và bảo vệ cổ tay.',
            'price' => 1200000,
            'stock' => 36,
            'discount' => 20,
            'image' => 'product/shopping.webp',
            'category_id' => 9,
        ]);

        Product::create([
            'product_name' => 'Case máy tính Xigmatek Aqua III Marvel Edition',
            'orientation' => 'Case thép chất lượng, thiết kế Marvel độc quyền, hiệu suất làm mát tốt.',
            'description' => 'Xigmatek Aqua III Marvel Edition có kiểu dáng đẹp, hỗ trợ nhiều loại mainboard, giúp xây dựng dàn PC cá tính.',
            'price' => 1290000,
            'stock' => 20,
            'discount' => 10,
            'image' => 'product/19909-70158_xigmatek_aqua_iii_mv_2_.webp',
            'category_id' => 7,
        ]);
    }
}
