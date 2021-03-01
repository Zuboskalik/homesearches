<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class HomesearchesSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->delimiter = ',';
        $this->file = '/database/seeds/csvs/property-data.csv';
        $this->mapping = ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'];
        $this->tablename = 'homesearches';
        $this->truncate = true;
        $this->timestamps = false;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();
        parent::run();
    }
}