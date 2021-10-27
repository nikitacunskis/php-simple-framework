<?php


namespace App;


class Menu
{
    private $menuElements;
    private $db;

    public function __construct( string $menuName ) {

        $this->db = new Database();
        $result = $this->db->result("SELECT * FROM menu WHERE name = ?0", [$menuName]);
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $this->addElement(new MenuElement($row));
            }
        }
    }

    /**
     * @param mixed $menuElements
     */
    private function setMenuElements($menuElements) {
        $this->menuElements = $menuElements;
    }
    /**
     * @param MenuElement $menuElement
     */
    public function addElement(MenuElement $menuElement) {
        $this->menuElements[] = $menuElement;
    }

    /**
     * @return array
     */
    private function getMenuElements() : array
    {
        return $this->menuElements;
    }

    /**
     * @return string
     */
    public function fetch() : string
    {
        $tpl = new Template('engine/menu/empty-menu');
        foreach ($this->getMenuElements() as $i => $menuElement)
        {
            $menuElementTpl = new Template('engine/menu/menu_element');
            $menuElementTpl->assign('ENGINE_MENU_LINK', $menuElement->getLink());
            $menuElementTpl->assign('ENGINE_MENU_ICON', $menuElement->getIcon());
            $menuElementTpl->assign('ENGINE_MENU_TEXT', $menuElement->getText());
            $tpl->assign('MENU', $menuElementTpl->fetch(), false);
        }
        return $tpl->fetch();
    }
}