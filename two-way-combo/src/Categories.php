<?php

class Categories
{
    // 16 char limit
    public static array $gem_categories = array(
        'birth', 'death', 'healing', 'love', 'protection', 'return', 'strength', 'war'
    );

    public static function prev_category( string $category ) {
        $index = array_search( $category, self::$gem_categories, true );
        $num_categories = count( self::$gem_categories );
        $prev_index = ($index + $num_categories - 1) % $num_categories;
        return self::$gem_categories[$prev_index];
    }

    public static function next_category( string $category ) {
        $index = array_search( $category, self::$gem_categories, true );
        $num_categories = count( self::$gem_categories );
        $next_index = ($index + 1) % $num_categories;
        return self::$gem_categories[$next_index];
    }
}
