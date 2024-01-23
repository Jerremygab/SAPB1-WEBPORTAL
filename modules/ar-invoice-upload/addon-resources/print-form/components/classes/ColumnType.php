<?php

enum ColumnType: int
{
    case MONEY = 0;
    case NUMBER = 1;
    case DATE = 2;
    case TEXT = 3;
    case ROW_NUMBER = 4;
    case EMPTY = 5;
}