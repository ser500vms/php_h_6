<?php
class Render {
    public static function renderExceptionPage(Exception $e) {
        return "<h1>Ошибка</h1><p>{$e->getMessage()}</p>";
    }
}
