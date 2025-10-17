<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    
    /**
     * Chạy các lệnh seed của cơ sở dữ liệu.
     *
     * @return void
     */
    public function run()
    {
        
        Product::create([
            "product_name" => "CPU Intel Core i5-12400F",
            "orientation" => "Bộ vi xử lý Intel Core i5-12400F hiệu năng cao, phù hợp cho game và làm việc.",
            "description" => "Intel Core i5-12400F có 6 nhân 12 luồng, xung nhịp tối đa 4.4GHz, hỗ trợ DDR4/DDR5. Dòng CPU này mang lại hiệu năng ổn định cho cả gaming và công việc văn phòng, tiết kiệm điện năng, không tích hợp GPU.",
            "price" => 4200000,
            "stock" => 40,
            "discount" => 5,
            "image" => "product/cpu_i5_12400f.jpg",
            "category_id" => 1,
        ]);

        Product::create([
            "product_name" => "Mainboard ASUS B660M-A D4",
            "orientation" => "Bo mạch chủ ASUS B660M-A D4 hỗ trợ CPU Intel thế hệ 12, thiết kế chắc chắn, nhiều cổng kết nối.",
            "description" => "Mainboard ASUS B660M-A D4 có socket LGA1700, hỗ trợ RAM DDR4, PCIe 4.0, M.2 NVMe, cổng USB 3.2 Gen 2. Thiết kế tản nhiệt VRM tốt, đảm bảo hiệu suất ổn định khi sử dụng lâu dài.",
            "price" => 3200000,
            "stock" => 30,
            "discount" => 0,
            "image" => "product/mainboard_b660m_a_d4.jpg",
            "category_id" => 1,
        ]);

        Product::create([
            "product_name" => "RAM Corsair Vengeance LPX 16GB (2x8GB) DDR4 3200MHz",
            "orientation" => "RAM hiệu năng cao cho PC gaming và làm việc, độ bền và tốc độ vượt trội.",
            "description" => "Corsair Vengeance LPX 16GB DDR4 3200MHz gồm 2 thanh 8GB, tản nhiệt nhôm hiệu quả, tương thích tốt với nhiều mainboard. Giúp hệ thống hoạt động mượt mà, đặc biệt trong đa nhiệm và chơi game.",
            "price" => 1300000,
            "stock" => 50,
            "discount" => 10,
            "image" => "product/ram_corsair_vengeance_16gb.jpg",
            "category_id" => 1,
        ]);

        Product::create([
            "product_name" => "SSD Samsung 980 500GB NVMe M.2",
            "orientation" => "Ổ cứng SSD tốc độ cao chuẩn NVMe, giúp khởi động máy và ứng dụng cực nhanh.",
            "description" => "Samsung 980 500GB NVMe sử dụng giao thức PCIe 3.0, tốc độ đọc lên đến 3500MB/s. Thiết kế nhỏ gọn, độ bền cao, là lựa chọn lý tưởng cho game thủ và dân đồ họa.",
            "price" => 1550000,
            "stock" => 60,
            "discount" => 0,
            "image" => "product/ssd_samsung_980_500gb.jpg",
            "category_id" => 1,
        ]);

        Product::create([
            "product_name" => "Card đồ họa MSI RTX 3060 Ventus 2X 12G",
            "orientation" => "Card đồ họa RTX 3060 mạnh mẽ cho game và đồ họa chuyên nghiệp.",
            "description" => "MSI RTX 3060 Ventus 2X 12G sử dụng kiến trúc Ampere của NVIDIA, 12GB GDDR6, hỗ trợ Ray Tracing và DLSS. Hiệu năng cao, tản nhiệt kép, hoạt động êm ái và ổn định.",
            "price" => 8900000,
            "stock" => 25,
            "discount" => 0,
            "image" => "product/gpu_rtx3060_ventus2x.jpg",
            "category_id" => 1,
        ]);

        Product::create([
            "product_name" => "Nguồn máy tính Cooler Master MWE 650W 80 Plus Bronze",
            "orientation" => "Nguồn 650W công suất thực, đạt chuẩn 80 Plus Bronze tiết kiệm điện và ổn định.",
            "description" => "Cooler Master MWE 650W cung cấp điện ổn định cho dàn PC gaming. Quạt 120mm hoạt động êm, hiệu suất cao, dây cáp bọc lưới gọn gàng. Đảm bảo an toàn cho linh kiện của bạn.",
            "price" => 1200000,
            "stock" => 40,
            "discount" => 0,
            "image" => "product/psu_cooler_master_650w.jpg",
            "category_id" => 1,
        ]);
    }
}
