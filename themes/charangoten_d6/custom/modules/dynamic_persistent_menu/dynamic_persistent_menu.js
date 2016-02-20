var overMenu;
var overStatus = 1;

$(document).ready(function()
{
  overMenu = overMenuDefault;

  // Show current submenu, hide previous submenu, if any.
  $(".dynamic-persistent-menu-menu-item").mouseover(
    function ()
    {
        overStatus = 1 ;
        
        // If there was a previous menu which received a mouseover, hide the submenu.
        if (overMenu)
        {
          subMenu = dynamic_persistent_menu_get_sub_menu(overMenu);
          $('#' + subMenu).hide();
          $('#' + overMenu).removeClass('dynamic-persistent-menu-children-active');
        }
        // Show the submenu of the current menu.
        overMenu = this.id;
        subMenu = dynamic_persistent_menu_get_sub_menu(overMenu);
        $('#' + subMenu).show();
        $('#' + this.id).addClass('dynamic-persistent-menu-children-active')
    }
    ).mouseout(
        // Set timeout for the hide function
        dynamic_persistent_menu_set_timeout
      );

    // Keep over status as long as mouse is over the current menu.
    $(".dynamic-persistent-menu-sub-menu").mouseover(
        function()
        {
          if (dynamic_persistent_menu_get_sub_menu(overMenu) == this.id)
          {
            overStatus = 1;
          }
        }
      ).mouseout(
dynamic_persistent_menu_set_timeout
        )
});

/**
 * Get the id of the submenu of a menu, given its id.
 */
function dynamic_persistent_menu_get_sub_menu(menu_id)
{
  return menu_id.replace('dynamic-persistent-menu-menu','dynamic-persistent-menu-sub-menu');
}

/**
 * Reset all submenus and the corresponding statuses.
 */
function dynamic_persistent_menu_reset()
{
  if (!overStatus)
  {
    $('#' + dynamic_persistent_menu_get_sub_menu(overMenu)).hide();
    $('#' + overMenu).removeClass('dynamic-persistent-menu-children-active');
    overMenu = overMenuDefault;
    $('#' + dynamic_persistent_menu_get_sub_menu(overMenu)).show();
  }
}

/**
 * Call timeout function.
 */

function dynamic_persistent_menu_set_timeout()
{
  overStatus = 0 ;
  setTimeout( 'dynamic_persistent_menu_reset()' , subMenuTimeout );
}