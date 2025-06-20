<?php

namespace App\Entities;

class DatabaseEntity
{
    const SQL_READ = "mysql_read";

    const USER             = "users";
    const STUDENTS             = "students";
    const KELAS            = "class";
    const TOUR_PLACE       = "tour_places";
    const TOUR_PACKAGE     = "tour_packages";
    const TOUR_ITENARY     = "tour_itenaries";
    const TOUR_ITENARY_DAY = "tour_itenary_days";
    const TOUR_PRICE       = "tour_prices";
    const ARTICLE          = "articles";
    const RENT             = "rents";
    const RENT_TYPE        = "rent_types";


    const BOOK = "books";
    const BOOK_CATEGORY = "book_categories";
    const GUEST = "guests";
    const BOOK_STOCK = "book_stocks";
    const BOOKSHELVE = "bookshelves";

    const MEMBER = "members";
    const MEMBER_CATEGORY = "member_categories";

    const SETTING = "setting";

    const LOAN = "loans";
    const LOAN_DETAIL = "loan_details";
}
