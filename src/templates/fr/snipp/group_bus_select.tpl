Dans le groupe / bus :
<select name="s_groups" id="s_groups" >
<option value="" {% if s_grp_id == '' %}selected="selected"{% endif %}  >---</option>
{% for group in groups %}
<option value="{{group.id}}" {% if s_grp_id == group.id %}selected="selected"{% endif %}  >{{group.name}}</option>
{% endfor %}
</select>
<select name="s_buses" id="s_buses" >
<option value="" {% if s_bus_id == '' %}selected="selected"{% endif %}  >---</option>
{% for bus in buses %}
<option value="{{bus.id}}" {% if s_bus_id == bus.id %}selected="selected"{% endif %}  >{{bus.name}}</option>
{% endfor %}
</select>
