<?php


namespace App;


class TreeBuilder
{
    private static $parentField = '';
    private static $childrenField = '';
    private static $keyField = '';

    /** Построение дерева
     * @param $flat - сплошной массив
     * @param $root - ID корневого родительского элемента
     * @param string $parentField - название родительского поля (по умолчанию parent_id)
     * @param string $childrenField - поле для сохранения дочерних узлов (по умолчанию children)
     * @param string $keyField - ключевое поле (по умолчанию id)
     * @return array - дерево
     */
    public static function buildTree($flat, $root, $parentField = 'parent_id', $childrenField = 'children', $keyField = 'id') {
        self::$parentField = $parentField;
        self::$childrenField = $childrenField;
        self::$keyField = $keyField;

        $parents = [];
        foreach ($flat as $item) {
            $parents[$item[$parentField]][] = $item;
        }
        return self::buildBranch($parents, $parents[$root]);
    }

    /** Посроение ветки
     * @param $parents - массив со всеми родителями
     * @param $children - дети текущей ветки
     * @return array список узлов текущей ветки
     */
    private static function buildBranch(&$parents, $children) {
        $tree = [];
        foreach ($children as $child) {
            if (isset($parents[$child[self::$keyField]])) {
                $child[self::$childrenField] = self::buildBranch($parents, $parents[$child[self::$keyField]]);
            }
            $tree[] = $child;
        }
        return $tree;
    }
}