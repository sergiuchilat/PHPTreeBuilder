<?
namespace App;

trait TreeBuilder {
    /** Построение дерева
     * @param $flat - сплошной массив
     * @param $root - ID корневого родительского элемента
     * @param string $parentField - название родительского поля (по умолчанию parent_id)
     * @param string $childrenField - поле для сохранения дочерних узлов (по умолчанию children)
     * @param string $keyField - ключевое поле (по умолчанию id)
     * @return array - дерево
     */
    public function buildTree($flat, $root, $parentField = 'parent_id', $childrenField = 'children', $keyField = 'id') {
        $parents = [];
        foreach ($flat as $item) {
            $parents[$item[$parentField]][] = $item;
        }
        return $this->buildBranch($parents, $parents[$root], $childrenField, $keyField);
    }

    /** Посроение ветки
     * @param $parents - массив со всеми родителями
     * @param $children - дети текущей ветки
     * @param string $childrenField - поле для сохранения дочерних узлов
     * @param string $keyField - ключевое поле (по умолчанию id)
     * @return array список узлов текущей ветки
     */
    private function buildBranch(&$parents, $children, $childrenField, $keyField) {
        $branch = [];
        foreach ($children as $child) {
            if (isset($parents[$child[$keyField]])) {
                $child[$childrenField] = $this->buildBranch($parents, $parents[$child[$keyField]], $childrenField, $keyField);
            }
            $branch[] = $child;
        }
        return $branch;
    }
}