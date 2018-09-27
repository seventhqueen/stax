<div class="item <% if (data.menu_type_field === 'modburger') { %> sq-menu-<%= data.menu_type_field %> <% } else { %> sq-menu <% } %>
    element-<%= data.uuid %>
    <%= data.stax_adv_classes %>"
    <% if (data.stax_adv_id) { %> id="<%= data.stax_adv_id %>" <% } %>>
    <% if (data.menu_type_field === 'modburger') { %>
        <div class="sq-menu-modburger-toggle">
            <span class="mdi mdi-menu mdi-24px"></span>
        </div>
        <div class="menu">
            <div class="sq-menu-modburger-close"><span class="mdi mdi-close mdi-24px"></span></div>
            <% if(data.menu_field) { %>
            [stax-menu slug="<%= data.menu_field %>"]
            <% } else { %>
            Please select a menu
            <% } %>
        </div>
    <% } else { %>
        <div class="menu-default item-child <%= data.menu_style_type_field %> <% if (data.menu_type_field === 'flexMenu') { %> <%= data.menu_type_field %> <% } %>">
            <% if(data.menu_field) { %>
            [stax-menu slug="<%= data.menu_field %>"]
            <% } else { %>
            Please select a menu
            <% } %>
        </div>
    <% } %>
</div>


