# PHPTreeBuilder
Утилита для создания древовидной структуры из массива
     
     Использование как Trait
     В модели:
     use TreeBuilder;
     
     В контроллере:
     $modelObject = new ModelObject();
     $tree = $modelObject->buildTree($list, 0);
     
     *************Использование как утилиту********************
     
     $tree = TreeBuilder::buildTree($list, 0)
     
     
    
     =============Входящие параметры метода buildTree:=======================
     buildTree($flat, $root, $parentField = 'parent_id', $childrenField = 'children', $keyField = 'id')
     @param $flat - сплошной массив
     @param $root - ID корневого родительского элемента
     @param string $parentField - название родительского поля (по умолчанию parent_id)
     @param string $childrenField - поле для сохранения дочерних узлов (по умолчанию children)
     @param string $keyField - ключевое поле (по умолчанию id)
     =========Использование как Trait=================
     
     
     *************Пример входящего массива flat****************
     $list = [
            [
                'id' => 1,
                'title' => 'Item 1',
                'parent_id' => 0
            ],
            [
                'id' => 2,
                'title' => 'Item 1.1',
                'parent_id' => 1
            ],
            [
                'id' => 3,
                'title' => 'Item 1.2',
                'parent_id' => 1
            ],
            [
                'id' => 4,
                'title' => 'Item 1.1.1',
                'parent_id' => 2
            ],
            [
                'id' => 5,
                'title' => 'Item 2',
                'parent_id' => 0
            ],
            [
                'id' => 6,
                'title' => 'Item NO parent',
                'parent_id' => 100
            ]
        ];
        
        **************** Формат результата****************
        [ 
          [0] => [
            [id] => 1 
            [title] => 
            Item 1 
            [parent_id] => 0 
            [children] => [
              [0] => [
                [id] => 2 
                [title] => 
                Item 1.1 
                [parent_id] => 1 
                  [children] => [
                    [0] => [
                      [id] => 4 
                      [title] => Item 1.1.1 
                      [parent_id] => 2 
                    ]
                  ]
              [1] => [ 
                [id] => 3 
                [title] => 
                Item 1.2 
                [parent_id] => 1 
              ]
            ]
          ]  
          [1] => [
            [id] => 5 
            [title] => 
            Item 2 
            [parent_id] => 0 
          ]
        ]
     
     
