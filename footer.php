<?IncludeTemplateLangFile(__FILE__);?>
			</div>
            <!-- // Content -->
            </div>

              <!-- Footer -->

            <footer>
            

                <!-- Bottom Block -->
                <div class="clear:both;"></div>
                	<?if (CSite::InDir(SITE_DIR.'index.php')) {?>
                		<div class="main_news_out">
	                	
	                		<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/news.php"), false);?>
	                	</div>
	                <?} 
						else {?>
					<?}?>
					
					<div style="clear:both;"></div>
				<div class="brick_wall_out">
					<div class="brick_wall">
		                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/payment_post_bricks.php"), false);?>
					</div>	
				</div>
				<div style="clear:both;"></div>

				<div  class="bottom-block-1">
				  <div  class="bottom-block-1_1">

				  

						<div style=" float:left; padding:10px;">
							<h2> Мега.онлайн</h2>
							<h4>Как с нами связаться:</h4>
							 <h4>8 (351) 751 09 19</h4>
							<h4>Челябинск, пр. Комсомольский 7</h4>
							<h4>sale@mirmega.ru</h4>
							<h4>Работаем пн — пт с 9 до 19, сб с 9 до 14</h4>
							<hr>
							<h4> <a href="http://xn--80aff1a.xn--80asehdb/e-store/">О магазине</a></h4>
							<h4> <a href="http://xn--80aff1a.xn--80asehdb/contacts/">Контакты</a></h4>
						</div>
							
						<div id="fb-root">
						</div>
						<script>
						 			(function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
							  		if (d.getElementById(id)) return;
							  		js = d.createElement(s); js.id = id;
							  		js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.4";
							  		fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));
						 </script>
				<div style="float:right; width:640px;">
					<div style="float:right; padding:10px;">
							<div class="fb-page" data-href="https://www.facebook.com/megaonlain" data-width="300" data-height="300" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
								<div class="fb-xfbml-parse-ignore">
									<blockquote cite="https://www.facebook.com/megaonlain">
						 <a href="https://www.facebook.com/megaonlain">Мега.онлайн</a>
									</blockquote>
								</div>
							</div>
					</div>

					<div style="float:left; padding:10px;">
							 <script type="text/javascript" src="//vk.com/js/api/openapi.js?117"></script> <!-- VK Widget -->
							<div id="vk_groups">
							</div>
							 <script type="text/javascript">
									VK.Widgets.Group("vk_groups", {mode: 2, width: "300", height: "300"}, 87640246);
							</script>
					</div>
				</div>
						<div style="clear:both">
						</div>
						<br>

					</div>
				</div>


				 <div class="bottom-block">
					<div class="brd">



						<div class="clear"></div>
					</div>
                </div>
                <!-- // Bottom Block -->


            </footer>
            <!-- // Footer -->
        
					<div class="copyright">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?>
					<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter28686586 = new Ya.Metrika({id:28686586,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    trackHash:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/28686586" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
					</div>
					
        <div class="overlay"></div>


    </body>
</html>