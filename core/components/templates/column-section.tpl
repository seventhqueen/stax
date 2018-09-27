<div class="<%= data.container_for %>-item sq-col element-<%= data.uuid %> <%= data.stax_adv_classes %>
    <% if (data.css_class_advanced) { %> <%= data.css_class_advanced %> <% } %>
    <% if (data.content_position_field) { %> <%= data.content_position_field %> <% } %>"
    <% if (data.css_id_advanced) { %> id="<%= data.css_id_advanced %>" <% } %>
    data-item-type="column" data-element-id="<%= data.uuid %>"
    <% if (data.width_field) { %> data-initial-width="<%= data.width_field %>" <% } %>
    <% if (data.stax_adv_id) { %> id="<%= data.stax_adv_id %>" <% } %>>
    {{columnOverlay}}
</div>
