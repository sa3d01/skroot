<?php

namespace App\Imports;

use App\Http\Enums\ProductTypes;
use App\Models\CarBrand;
use App\Models\CarBrandModel;
use App\Models\PartCategory;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $car = CarBrand::whereTranslation("name", $row["car_name"])->first();
            if (!$car) {
                $car = CarBrand::create([
                    "en" => ["name" => $row["car_name"]],
                    "ar" => ["name" => $row["car_name"]],
                ]);
            }

            $carModel = CarBrandModel::where('car_brand_id', $car->id)
                ->whereTranslation("name", $row["car_model"])->first();
            if (!$carModel) {
                $carModel = CarBrandModel::create([
                    'car_brand_id' => $car->id,
                    "en" => ["name" => $row["car_model"]],
                    "ar" => ["name" => $row["car_model"]],
                ]);
            }

            $partCategory = PartCategory::whereTranslation("name", $row["category_name"])->first();
            if (!$partCategory) {
                $partCategory = PartCategory::create([
                    "en" => ["name" => $row["category_name"]],
                    "ar" => ["name" => $row["category_name"]],
                ]);
            }

            $product = Product::where([
                "part_category_id" => $partCategory->id,
                "car_brand_id" => $car->id,
                "car_brand_model_id" => $carModel->id,
                "year" => $row["model_year"],
                "part_number" => $row["part_number"],
            ])->first();
            if (!$product) {
                $price = str_replace("$", "", $row["part_price"]);
                Product::create([
                    "type" => ProductTypes::PART,
                    "part_category_id" => $partCategory->id,
                    "car_brand_id" => $car->id,
                    "car_brand_model_id" => $carModel->id,
                    "year" => $row["model_year"],
                    "price" => (double)$price,
                    "part_number" => $row["part_number"],
                    "en" => [
                        "name" => $row["part_name"],
                        "description" => $row["part_description"],
                    ],
                    "ar" => [
                        "name" => $row["part_name"],
                        "description" => $row["part_description"],
                    ],
                ]);
            }

        }
    }
}
