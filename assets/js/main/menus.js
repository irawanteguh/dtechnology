datamenus();

function datamenus() {
    $.ajax({
        url     : url + "index.php/main/menus/datamenus",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function(){
            $("#listmenus").html("<div class='text-center text-muted p-5'>Loading menu...</div>");
        },
        success: function(data){
            if(data.responCode === "00"){
                let result = data.responResult;
                let html = "";

                const colors = [
                    "bg-primary",
                    "bg-success",
                    "bg-info",
                    "bg-warning",
                    "bg-danger"
                ];

                for(let i in result){
                    let icon  = result[i].icon ?? "fa-solid fa-cube";
                    let color = colors[i % colors.length];
                    let delay = (i * 0.1).toFixed(1); // Delay animasi tiap tile

                    html += `
                        <a href="${result[i].modules_url ?? '#'}" 
                           class="metro-tile ${color} animate__animated animate__bounceIn"
                           style="animation-delay: ${delay}s;">
                            <i class="${icon}"></i>
                            <span>${result[i].modules_name}</span>
                        </a>
                    `;
                }

                $("#listmenus").hide().html(html).fadeIn(200, function(){
                    // Efek hover Animate.css
                    $('.metro-tile').hover(
                        function() {
                            $(this).addClass('animate__animated animate__pulse');
                        },
                        function() {
                            $(this).removeClass('animate__animated animate__pulse');
                        }
                    );
                });
            } else {
                $("#listmenus").html("<div class='text-center text-danger p-5'>Menu tidak ditemukan</div>");
            }
        },
        error: function(){
            $("#listmenus").html("<div class='text-center text-danger p-5'>Gagal memuat data</div>");
        }
    });
}