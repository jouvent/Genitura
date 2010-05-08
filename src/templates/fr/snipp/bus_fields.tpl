
<h3>Le Chef de Bus</h3>
    {% include 'snipp/user_info.tpl' %}


<h3>Le Bus</h3>
<p>
    <label for="bus_name">Nom</label>
    <input type="text" name="bus_name" id="bus_name" value="{{bus.name}}" />
</p>
<p>
    <label for="bus_name">Location du bus</label>
    <input type="text" name="bus_location" id="bus_name" value="{{bus.location}}" />
</p>
<p>
    <label for="bus_name">Lien Google Maps</label>
    <input type="text" name="bus_googlemaps_url" id="bus_name" value="{{bus.googlemaps_url}}" />
</p>

{% if logged.type == 'A' %}

<h3>Les quantites d'invites pour le bus</h3>
<p>
    <label for="bus_size">Nb. de places dans le bus</label>
    <input type="text" name="bus_size" id="bus_size" value="{{bus.size}}" />
</p>
{% endif %}

