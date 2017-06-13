<?php
    class Menu 
    {
        
        function getMenu($id_app = null, $id_page,$id_menu_ref = 0)
        {
			if(isset($_SESSION['id_perms']) and $id_app == null ) {
					$id_perms = $_SESSION['id_perms'];
					switch ($id_perms) {
						case 3:
							$id_app = 4;

							break;
						case 4:
							$id_app = 2;
							

							break;

						default:

							break;
					}
			}
			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->menu
                        ->select("*")
                        ->where('id_app=?',$id_app)
                        ->and('id_menuref =?',$id_menu_ref)
						->and('status=?',1)
                        ->order('orders');
			$ConnectionORM -> close();
			return $q;            
        }
		function getMenuImage($id_app = null, $id_page,$id_menu_ref = 0)
        {
			if(isset($_SESSION['id_perms'])) {
				
				$id_perms = $_SESSION['id_perms'];
					switch ($id_perms) {
						case 3:
							$id_app = 4;

							break;
						case 4:
							$id_app = 2;

							break;

						default:

							break;
					}
			}

			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->menu
                        ->select("*")
                        ->where('id_app=?',$id_app)
                        ->and('id_menuref =?',$id_menu_ref)
						->and('status=?',1)
						->and('menu_image = ?',1)
                        ->order('orders');
			$ConnectionORM -> close();
			return $q;            
        }
    }