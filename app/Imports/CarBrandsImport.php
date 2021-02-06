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

class CarBrandsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $car = CarBrand::whereTranslation("name", $row["Manufacturer"])->first();
            if (!$car) {
                $car = CarBrand::create([
                    "en" => ["name" => $row["Manufacturer"]],
                    "ar" => ["name" => $row["Manufacturer"]],
                ]);
            }

            $carModel = CarBrandModel::where('car_brand_id', $car->id)
                ->whereTranslation("name", $row["Car Model"])->first();
            if (!$carModel) {
                $carModel = CarBrandModel::create([
                    'car_brand_id' => $car->id,
                    "en" => ["name" => $row["Car Model"]],
                    "ar" => ["name" => $row["Car Model"]],
                ]);
            }

            $partCategory = PartCategory::whereTranslation("name", $row["Category"])->first();
            if (!$partCategory) {
                $partCategory = PartCategory::create([
                    "en" => ["name" => $row["Category"]],
                    "ar" => ["name" => $row["Category"]],
                ]);
            }

            $product = Product::where([
                "part_category_id" => $partCategory->id,
                "car_brand_id" => $car->id,
                "car_brand_model_id" => $carModel->id,
                "year" => $row["Year"],
                "part_number" => $row["Part Number"],
            ])->first();
            if (!$product) {
                $price = str_replace("$", "", $row["Price"]);
                Product::create([
                    "type" => ProductTypes::PART,
                    "part_category_id" => $partCategory->id,
                    "car_brand_id" => $car->id,
                    "car_brand_model_id" => $carModel->id,
                    "year" => $row["Year"],
                    "price" => (double)$price,
                    "part_number" => $row["Part Number"],
                    "en" => [
                        "name" => $row["Part Name"],
                        "description" => $row["Part Name"],
                    ],
                    "ar" => [
                        "name" => $row["Part Name"],
                        "description" => $row["Part Name"],
                    ],
                ]);
            }

        }
    }
}
