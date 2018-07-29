jQuery(document).ready(function(){
    rssCtrl.l(); // Rempli la liste des actualités
    rssCtrl.clr(); // Initialise le formulaire
    
    $("form").submit(function(){
        rssCtrl.s($(this).serializeArray());
        return false;
    });
    
    $("#clear-btn").click(function(e){
        e.preventDefault();
        rssCtrl.clr();
    })
});


var rssCtrl = {
    l:function(){
        $.post("controller.php", {
            "do":"l"
        },
        function(data, textStatus){
            var items = [];
            $.each(data, function(key, item) {
                items.push('<li id="item-' + item.id + '">' +
                        '<span>' + item.title + '</span>' +
                        '<a href="javascript:void(0)" title="supprimer cette actu." class="delete">del.</a>' +
                        '<a href="javascript:void(0)" title="modifier cette actu." class="edit">mod.</a>' +
                    '</li>');
            });
            $('#itemList').empty().append(items.join(''));
            $('#itemList .delete').click(function(){
                var rege = /^item-([0-9]*)$/;
                var id =$(this).parent().attr("id");
                id = id.match(rege)[1]; // Récupere le nombre
                var data = $({
                    name:"id", 
                    value:id
                });
                rssCtrl.d(data);
            });
            $('#itemList .edit').click(function(){
                var rege = /^item-([0-9]*)$/;
                var id =$(this).parent().attr("id");
                id = id.match(rege)[1]; // Récupere le nombre
                var data = $({
                    name:"id", 
                    value:id
                });
                rssCtrl.r(data);
            });
        }, "json");
    },
    cl:function(){
        $.post("controller.php", {
            "do":"cl"
        },
        function(data, textStatus){
            var items = [];
            $.each(data, function(key, item) {
                items.push('<option value="' + item.id + '">' + item.title + '</option>');
            });
            $('#channel').empty().append(items.join(''));
        }, "json");
    },
    c:function(data){
        data.push({
            name:"do",
            value:"c"
        });
        $.post("controller.php",data,
            function(data, textStatus){
                if ($(data).attr('e') != null) {
                    console.error($(data).attr('e'));
                } else{
                    rssCtrl.l(); // Recharge la vue en liste
                    rssCtrl.clr(); // Vide le formulaire
                }
            }, "json");
    },
    r:function(data){
        data.push({
            name:"do",
            value:"r"
        });
        $.post("controller.php",data,
            function(data, textStatus){
                $("input#id").val($(data).attr("id"));
                $("input#title").val($(data).attr("title"));
                $("input#link").val($(data).attr("link"));
                $("input#pubDate").val($(data).attr("pubDate"));
                $("textarea#description").val($(data).attr("description"));
            }, "json");
    },
    u:function(data){
        data.push({
            name:"do",
            value:"u"
        });
        $.post("controller.php",data,
            function(data, textStatus){
                if ($(data).attr('e') != null) {
                    console.error($(data).attr('e'));
                }
                rssCtrl.l(); // Recharge la vue en liste
                rssCtrl.clr(); // Vide le formulaire
            }, "json");
    },
    s:function(data){
        if ($("input#id").val() == "") {
            rssCtrl.c(data); // Crée une actualité
        } else {
            rssCtrl.u(data); // Met à jour l'actualité en place        
        }    
    },
    d:function(data){
        data.push({
            name:"do",
            value:"d"
        });
        $.post("controller.php",data,
            function(data, textStatus){
                rssCtrl.l(); // Recharge la vue en liste
                rssCtrl.clr();
            }, "json");
    },
    clr:function(){
        $("input#id").val("");
        $("input#title").val("");
        $("input#link").val("");
        var o = new Date();
        $("input#pubDate").val(o.getFullYear() + "-" + (o.getUTCMonth() + 1) + "-" + o.getDate() +
            " " +
            o.getHours() + ":" + o.getMinutes());
        $("textarea#description").val("");
        rssCtrl.cl(); // Initialise le formulaire

    }
}