{% extends "organisation_base.tpl" %}

{% block ariane %}
<a href="/user/page/{{group_chief.id}}">{{group_chief.name}}</a>
 - {{block.super|safe}}
{% endblock %}
{% block action_list %}
    <li><a href="/user/inviter/{{user.id}}">My Guests</a> </li>
    <li> <a href="/bus/edit/{{bus.bus_id}}">Edit</a></li>
{% endblock %}

{% block column_left %}
    <h3>Contact</h3>
    {% include 'snipp/user_info.tpl' %}
{% endblock %}

{% block column_right %}
    <h3>Counters</h3>
        <p class="data_row">
            <span class="vacant">Bus places nb. : </span> 
            <span class="data_box {{user.type|slug_title}}">{{bus.size}}</span>
        </p>
        <p class="data_row">
            <span class="confirmed">Confirmed</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.confirmes}}</span>
        </p>
        <p class="data_row">
            <span class="available">Available</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.disponibles}}</span>
        </p>
    <h3>Mon Bus</h3>
    <form name="couples" id="couples" method="POST" action="/bus/couples/{{bus.bus_id}}">
    {% include 'snipp/couple_order_list.tpl' %}
    <input type="submit" name="submit" value="Send">
    </form>
{% endblock %}

{% block no_column %}
    <h3>Notes</h3>
    <form name="note" id="note" action="/note/edit/{{user.id}}" method="post">
        <p><label for="note_content">Note about the group </label></p>
        <p><textarea name="content" id="note_content"></textarea></p>
        <p><input type="submit" value="Save"/></p>
        <input type="hidden" name="user" value="{{user.id}}" />
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            // handle form submit in javascript
            $('#note').ajaxForm(function() {
                alert("Note saved !");
            });
        });
        // get the note by type
        function get_note(){
            $.getJSON('/admin/notes.php?type='+$('#note_type').val(),function(data){$('#note_content').val(data.content);})
        }
    </script>
    <h3>Email</h3>
    <form name="email" id="email" action="/email/bus/{{bus.bus_id}}" method="post">
        <p>Email to Bus's guests</p>
        <p><label for="email_subject">Sujet:</label><input type="text" name="email_subject" id="email_subject"/></p>
        <p><label for="email_body">Content:</label><textarea name="email_body"></textarea></p>
        <p><label for="attachement">Attach a File</label><input type="file" name="attachement" id="attachement" /> </p>
        <p><input type="reset" value="Effacer"/><input name="submit" type="submit" value="Envoyer"/></p>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            // handle form submit in javascript
            $('#email').ajaxForm(function() {
                alert("Email sent!");
            });
        });
    </script>
{% endblock %}
