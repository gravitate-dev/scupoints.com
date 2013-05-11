function comSlider1320() { 
var self = this; 
var g_HostRoot = "";
var g_TransitionTimeoutRef = null;
var g_CycleTimeout = 4;
var g_currFrame = 0;
var g_currDate = new Date(); var g_currTime = g_currDate.getTime();var g_microID = g_currTime + '-' + Math.floor((Math.random()*1000)+1); 
var g_InTransition = 0;this.getCurrMicroID = function() { return g_microID; } 
var g_kb = new Array();
   this.kenburns = function(options) {                  
                                var ctx = jqCS1320("#"+options.name)[0].getContext('2d');
                                var thisobj = this;

                                var start_time = 0;
                                                            //var width = $thiscanvas.width();
                                                            //var height = $thiscanvas.height();	
                                                            var width = options.width;
                                                            var height = options.height;	


                                var image_path = options.image;		
                                var display_time = options.display_time || 7000;
                                var fade_time = options.fade_time || 0;
                                var fade_called = false;
                                var frames_per_second = options.frames_per_second || 30;		
                                var frame_time = (1 / frames_per_second) * 1000;
                                var zoom_level = 1 / (options.zoom || 2);
                                var clear_color = options.background_color || '#000000';	

                                var onstop = null;
                                var onloaded = null;
                                var onfade = null;

                                var timer_ref = null;
                                var images = [];
                                images.push({path:image_path,
                                                        initialized:false,
                                                        loaded:false});
                                function get_time() {
                                        var d = new Date();
                                        return d.getTime() - start_time;
                                }

                                function interpolate_point(x1, y1, x2, y2, i) {
                                        // Finds a point between two other points
                                        return  {x: x1 + (x2 - x1) * i,
                                                        y: y1 + (y2 - y1) * i}
                                }

                                function interpolate_rect(r1, r2, i) {
                                        // Blend one rect in to another
                                        var p1 = interpolate_point(r1[0], r1[1], r2[0], r2[1], i);
                                        var p2 = interpolate_point(r1[2], r1[3], r2[2], r2[3], i);
                                        return [p1.x, p1.y, p2.x, p2.y];
                                }

                                function scale_rect(r, scale) {
                                        // Scale a rect around its center
                                        var w = r[2] - r[0];
                                        var h = r[3] - r[1];
                                        var cx = (r[2] + r[0]) / 2;
                                        var cy = (r[3] + r[1]) / 2;
                                        var scalew = w * scale;
                                        var scaleh = h * scale;
                                        return [cx - scalew/2,
                                                        cy - scaleh/2,
                                                        cx + scalew/2,
                                                        cy + scaleh/2];		
                                }

                                function fit(src_w, src_h, dst_w, dst_h) {
                                        // Finds the best-fit rect so that the destination can be covered
                                        var src_a = src_w / src_h;
                                        var dst_a = dst_w / dst_h;			
                                        var w = src_h * dst_a;
                                        var h = src_h;						
                                        if (w > src_w)
                                        {
                                                var w = src_w;
                                                var h = src_w / dst_a;
                                        }						
                                        var x = (src_w - w) / 2;
                                        var y = (src_h - h) / 2;
                                        return [x, y, x+w, y+h]; 
                                }				

                                function get_image_info() {
                                        // Gets information structure for a given index
                                        // Also loads the image asynchronously, if required		
                                        var image_info = images[0];
                                        if (!image_info.initialized) {
                                                var image = new Image();
                                                image_info.image = image;
                                                image_info.loaded = false;
                                                image.onload = function(){
                                                        image_info.loaded = true;
                                                        var iw = image.width;
                                                        var ih = image.height;

                                                        var r1 = fit(iw, ih, width, height);;
                                                        var r2 = scale_rect(r1, zoom_level);

                                                        var align_x = Math.floor(Math.random() * 3) - 1;
                                                        var align_y = Math.floor(Math.random() * 3) - 1;
                                                        align_x /= 2;
                                                        align_y /= 2;

                                                        var x = r2[0];
                                                        r2[0] += x * align_x;
                                                        r2[2] += x * align_x; 

                                                        var y = r2[1];
                                                        r2[1] += y * align_y;
                                                        r2[3] += y * align_y;

                                                        if (Math.floor((Math.random()*10)) % 2) {
                                                                image_info.r1 = r1;
                                                                image_info.r2 = r2;
                                                        }
                                                        else {
                                                                image_info.r1 = r2;
                                                                image_info.r2 = r1;
                                                        }					

                                                        if (options.onloaded) {
                                                                options.onloaded(thisobj);
                                                        }					

                                                }				
                                                image_info.initialized = true;
                                                image.src = image_info.path;
                                        }
                                        return image_info;
                                }

                                function render_image(image_index, anim) {
                                        // Renders a frame of the effect	
                                        if (anim > 1) {
                                                return;
                                        } 									
                                        var image_info = get_image_info();
                                        if (image_info.loaded) {						
                                                var r = interpolate_rect(image_info.r1, image_info.r2, anim);

                                                ctx.save();
                                                ctx.globalAlpha = 1;
                                                ctx.drawImage(image_info.image, r[0], r[1], r[2] - r[0], r[3] - r[1], 0, 0, width, height);
                                                ctx.restore();

                                        }
                                }				

                                function clear() {
                                        // Clear the canvas
                                        ctx.save();
                                        ctx.globalAlpha = 1;
                                        ctx.fillStyle = clear_color;
                                        ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                                        ctx.restore();
                                }


                                function update() {

                                        // Render the next frame										
                                        var time_passed = get_time();	

                                        render_image(0, time_passed / display_time/*, time_passed / fade_time*/);			

                                        if ((fade_time > 0) && (fade_called == false) && ((display_time - time_passed) <= fade_time))
                                        {
                                                if (options.onfade) {
                                                        options.onfade(thisobj, display_time - time_passed);	
                                                }					
                                                fade_called = true;					
                                        }

                                        if (time_passed >= display_time)
                                        {
                                                thisobj.stop();
                                                return;
                                        }
                                }

                                this.stop = function()
                                {
                                        if (timer_ref != null)
                                                clearInterval(timer_ref);
                                        timer_ref = null;
                                        //clear();
                                        images[0].initialized = null;			
                                        if (options.onstop) {
                                                options.onstop(thisobj);
                                        }
                                }

                                this.start = function()
                                {
                                        fade_called = false;		
                                        start_time = 0;
                                        start_time = get_time();	
                                        timer_ref = setInterval(update, frame_time);	
                                }

                                get_image_info();	
                                return this;	
                        }	
               this.setNavStyle = function(id, background, color, border, type)
{
 if (background == "")
 {
     jqCS1320("#comSNavigation1320_"+id).css("background", "none");
 }
 else
 {
     jqCS1320("#comSNavigation1320_"+id).css("background", "#"+background);
 }
 jqCS1320("#comSNavigation1320_"+id).css("background", "#"+background);
 jqCS1320("#comSNavigation1320_"+id).css("color", "#"+color);
 jqCS1320("#comSNavigation1320_"+id).css("border", border+"px solid #"+color);
 var margin = (-1)*border;
 jqCS1320("#comSNavigation1320_"+id).css("margin-top", margin+"px");
 jqCS1320("#comSNavigation1320_"+id).css("margin-left", margin+"px");
 if (type == 0)
 {
   jqCS1320("#comImgBullet1320_"+id).show();
   jqCS1320("#comImgBulletcurr1320_"+id).hide();
 }
 else
 {
   jqCS1320("#comImgBulletcurr1320_"+id).show();
   jqCS1320("#comImgBullet1320_"+id).hide();
 }
}
this.targetClearTimeouts = function()
{
 if (g_TransitionTimeoutRef != null)     { window.clearTimeout(g_TransitionTimeoutRef); g_TransitionTimeoutRef = null;}
}
this.getNextFrame = function()
{
 g_currFrame++;
 if (g_currFrame == 5) {g_currFrame = 0;}
}
this.stopAll = function()
{
jqCS1320("#comSFrame1320_0").stop(true, true);
jqCS1320("#comSFrameSek1320_0").stop(true, true);
jqCS1320("#comSFrame1320_1").stop(true, true);
jqCS1320("#comSFrameSek1320_1").stop(true, true);
jqCS1320("#comSFrame1320_2").stop(true, true);
jqCS1320("#comSFrameSek1320_2").stop(true, true);
jqCS1320("#comSFrame1320_3").stop(true, true);
jqCS1320("#comSFrameSek1320_3").stop(true, true);
jqCS1320("#comSFrame1320_4").stop(true, true);
jqCS1320("#comSFrameSek1320_4").stop(true, true);
}
this.switchFrame = function()
{
     var currFrame=g_currFrame;
     self.getNextFrame();
     self.switchFromToFrame(currFrame, g_currFrame);
}
 
this.switchToFrame = function(toFrame)
{
     if ((g_InTransition == 1) || (g_currFrame == toFrame))
     {
         if (g_currFrame == toFrame) { return false; }
         self.stopAll();
     }
     var currFrame=g_currFrame;
     g_currFrame=toFrame;
     self.switchFromToFrame(currFrame, g_currFrame);
}
 
this.switchFromToFrame =  function(currFrame, toFrame)
{
     if (g_InTransition == 1)
     {
         self.stopAll();
     }
g_InTransition = 1;
self.startTransitionTimer();
g_kb[toFrame].start();
     jqCS1320("#comSFrameSek1320_"+currFrame+"").css("z-index", 100);
     jqCS1320("#comSFrameSek1320_"+toFrame+"").css("z-index", 200);
     jqCS1320("#comSFrameSek1320_"+toFrame+"").hide().fadeIn(2500, function() { 
if (g_microID !=objcomSlider1320.getCurrMicroID()){return false;};jqCS1320("#comSFrame1320_"+currFrame).hide(); g_InTransition = 0;
 } ); 
  self.setNavStyle(currFrame, 'ffffff','000000',0, 0);  self.setNavStyle(toFrame, 'ffffff','000000',0, 1);     jqCS1320("#comSFrame1320_"+toFrame).show(1, function(){  });
g_kb[currFrame].stop();
     
     
     
     
}
this.startTransitionTimer = function()
{
  self.targetClearTimeouts(); g_TransitionTimeoutRef = window.setTimeout(function() {objcomSlider1320.onTransitionTimeout(g_microID)}, g_CycleTimeout*1000);
}
this.onTransitionTimeout = function(microID)
{
   if (g_microID != microID) { return false; }
     self.switchFrame();
}
this.initFrame = function()
{
g_currFrame = 0;
self.startTransitionTimer();
g_kb[0].start();
     jqCS1320("#comSFrame1320_"+g_currFrame).show(1, function(){if (g_microID !=objcomSlider1320.getCurrMicroID()){return false;}; self.setNavStyle(g_currFrame, 'ffffff','000000',0, 1);     });
  return true;
}

                this.scriptLoaded = function()
                {
                    jqCS1320 = jQuery1320.noConflict(false);
                    jqCS1320("#comslider_in_point_1320").html('<div id="comSWrapper1320_" name="comSWrapper1320_" style="overflow:hidden; background: none; border:0px solid #00ff00; width:500px; height:400px; position: relative;"><div id="comSFrame1320_0" name="comSFrame1320_0" style="position:absolute; top:0px; left:0px; width:500px; height:400px;"><div id="comSFrameSek1320_0" name="comSFrameSek1320_0" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><div id="comSImg1320_0" name="comSImg1320_0" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><canvas id="kenburns0" width="500" height="400"><p>Unfortunately, your browser does not support slider of this type!</p></canvas></div></div></div><div id="comSFrame1320_1" name="comSFrame1320_1" style="position:absolute; top:0px; left:0px; width:500px; height:400px;"><div id="comSFrameSek1320_1" name="comSFrameSek1320_1" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><div id="comSImg1320_1" name="comSImg1320_1" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><canvas id="kenburns1" width="500" height="400"><p>Unfortunately, your browser does not support slider of this type!</p></canvas></div></div></div><div id="comSFrame1320_2" name="comSFrame1320_2" style="position:absolute; top:0px; left:0px; width:500px; height:400px;"><div id="comSFrameSek1320_2" name="comSFrameSek1320_2" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><div id="comSImg1320_2" name="comSImg1320_2" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><canvas id="kenburns2" width="500" height="400"><p>Unfortunately, your browser does not support slider of this type!</p></canvas></div></div></div><div id="comSFrame1320_3" name="comSFrame1320_3" style="position:absolute; top:0px; left:0px; width:500px; height:400px;"><div id="comSFrameSek1320_3" name="comSFrameSek1320_3" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><div id="comSImg1320_3" name="comSImg1320_3" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><canvas id="kenburns3" width="500" height="400"><p>Unfortunately, your browser does not support slider of this type!</p></canvas></div></div></div><div id="comSFrame1320_4" name="comSFrame1320_4" style="position:absolute; top:0px; left:0px; width:500px; height:400px;"><div id="comSFrameSek1320_4" name="comSFrameSek1320_4" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><div id="comSImg1320_4" name="comSImg1320_4" style="position:absolute; overflow:hidden; top:0px; left:0px; width:500px; height:400px;"><canvas id="kenburns4" width="500" height="400"><p>Unfortunately, your browser does not support slider of this type!</p></canvas></div></div></div><a name="0" style="cursor:pointer; text-decoration:none !important; font-size:24px;" href=""><div id="comSNavigation1320_0" name="comSNavigation1320_0" style="margin-left:0px; margin-top:0px; border: 0px solid #000000; position:absolute; height:30px; width:30px; top:5px; left:325px; z-index: 1000; text-align: center; vertical-align:bottom;  color: #000000;background: #ffffff; "><p style="line-height:30px;margin:0px;padding:0px;">1</p></div></a><a name="1" style="cursor:pointer; text-decoration:none !important; font-size:24px;" href=""><div id="comSNavigation1320_1" name="comSNavigation1320_1" style="margin-left:0px; margin-top:0px; border: 0px solid #000000; position:absolute; height:30px; width:30px; top:5px; left:360px; z-index: 1000; text-align: center; vertical-align:bottom;  color: #000000;background: #ffffff; "><p style="line-height:30px;margin:0px;padding:0px;">2</p></div></a><a name="2" style="cursor:pointer; text-decoration:none !important; font-size:24px;" href=""><div id="comSNavigation1320_2" name="comSNavigation1320_2" style="margin-left:0px; margin-top:0px; border: 0px solid #000000; position:absolute; height:30px; width:30px; top:5px; left:395px; z-index: 1000; text-align: center; vertical-align:bottom;  color: #000000;background: #ffffff; "><p style="line-height:30px;margin:0px;padding:0px;">3</p></div></a><a name="3" style="cursor:pointer; text-decoration:none !important; font-size:24px;" href=""><div id="comSNavigation1320_3" name="comSNavigation1320_3" style="margin-left:0px; margin-top:0px; border: 0px solid #000000; position:absolute; height:30px; width:30px; top:5px; left:430px; z-index: 1000; text-align: center; vertical-align:bottom;  color: #000000;background: #ffffff; "><p style="line-height:30px;margin:0px;padding:0px;">4</p></div></a><a name="4" style="cursor:pointer; text-decoration:none !important; font-size:24px;" href=""><div id="comSNavigation1320_4" name="comSNavigation1320_4" style="margin-left:0px; margin-top:0px; border: 0px solid #000000; position:absolute; height:30px; width:30px; top:5px; left:465px; z-index: 1000; text-align: center; vertical-align:bottom;  color: #000000;background: #ffffff; "><p style="line-height:30px;margin:0px;padding:0px;">5</p></div></a></div>');
                    jqCS1320("#comslider_in_point_1320 a").bind('click',  function() { if ((this.name.length > 0) && (isNaN(this.name) == false)) { self.switchToFrame(parseInt(this.name)); return false;} });
                
                        g_kb[0] = new self.kenburns({
                                name: 'kenburns0',
                                width: 500,
                                height: 400,
image:'comslider1320/img/FJF-SCU-0944FAO.JPG?1363760451',
     frames_per_second: 30,
                                display_time: 5000, 
                                fade_time: 0,
                                zoom: 1.5,
                                background_color:'#ffffff',
                                onstop:function(kenburnsobj) { },
                                onloaded:function(kenburnsobj) { },
                                onfade:function(kenburnsobj, timeleft) { }
                        });

                        g_kb[1] = new self.kenburns({
                                name: 'kenburns1',
                                width: 500,
                                height: 400,
image:'comslider1320/img/images.jpg?1363760451',
     frames_per_second: 30,
                                display_time: 5000, 
                                fade_time: 0,
                                zoom: 1.5,
                                background_color:'#ffffff',
                                onstop:function(kenburnsobj) { },
                                onloaded:function(kenburnsobj) { },
                                onfade:function(kenburnsobj, timeleft) { }
                        });
jqCS1320("#comSFrame1320_1").hide();

                        g_kb[2] = new self.kenburns({
                                name: 'kenburns2',
                                width: 500,
                                height: 400,
image:'comslider1320/img/large_The_Arts_and_Science_Building_.jpg?1363760451',
     frames_per_second: 30,
                                display_time: 5000, 
                                fade_time: 0,
                                zoom: 1.5,
                                background_color:'#ffffff',
                                onstop:function(kenburnsobj) { },
                                onloaded:function(kenburnsobj) { },
                                onfade:function(kenburnsobj, timeleft) { }
                        });
jqCS1320("#comSFrame1320_2").hide();

                        g_kb[3] = new self.kenburns({
                                name: 'kenburns3',
                                width: 500,
                                height: 400,
image:'comslider1320/img/santa-clara-university-front.jpg?1363760451',
     frames_per_second: 30,
                                display_time: 5000, 
                                fade_time: 0,
                                zoom: 1.5,
                                background_color:'#ffffff',
                                onstop:function(kenburnsobj) { },
                                onloaded:function(kenburnsobj) { },
                                onfade:function(kenburnsobj, timeleft) { }
                        });
jqCS1320("#comSFrame1320_3").hide();

                        g_kb[4] = new self.kenburns({
                                name: 'kenburns4',
                                width: 500,
                                height: 400,
image:'comslider1320/img/santa-clara-university-solar-decathlon-house.jpg?1363760451',
     frames_per_second: 30,
                                display_time: 5000, 
                                fade_time: 0,
                                zoom: 1.5,
                                background_color:'#ffffff',
                                onstop:function(kenburnsobj) { },
                                onloaded:function(kenburnsobj) { },
                                onfade:function(kenburnsobj, timeleft) { }
                        });
jqCS1320("#comSFrame1320_4").hide();
self.initFrame();

}
var g_CSIncludes = new Array();
var g_CSLoading = false;
var g_CSCurrIdx = 0; 
 this.include = function(src, last) 
                {
                    if (src != '')
                    {				
                            var tmpInclude = Array();
                            tmpInclude[0] = src;
                            tmpInclude[1] = last;					
                            //
                            g_CSIncludes[g_CSIncludes.length] = tmpInclude;
                    }            
                    if ((g_CSLoading == false) && (g_CSCurrIdx < g_CSIncludes.length))
                    {
                            var oScript = document.createElement('script');
                            oScript.src = g_CSIncludes[g_CSCurrIdx][0];
                            oScript.type = 'text/javascript';

                            //oScript.onload = scriptLoaded;
                            oScript.onload = function() 
                            { 
                                    if ( ! oScript.onloadDone ) 
                                    {
                                            oScript.onloadDone = true; 
                                            g_CSLoading = false;
                                            g_CSCurrIdx++;								
                                            if (g_CSIncludes[g_CSCurrIdx-1][1] == true) 
                                            {
                                                    self.scriptLoaded(); 
                                            }
                                            else
                                            {
                                                    self.include('', false);
                                            }
                                    }
                            };
                            oScript.onreadystatechange = function() 
                            { 
                                    if ( ( "loaded" === oScript.readyState || "complete" === oScript.readyState ) && ! oScript.onloadDone ) 
                                    {
                                            oScript.onloadDone = true;
                                            g_CSLoading = false;	
                                            g_CSCurrIdx++;
                                            if (g_CSIncludes[g_CSCurrIdx-1][1] == true) 
                                                    self.scriptLoaded(); 
                                            else
                                                    self.include('', false);
                                    }
                            }                        
                            //
                            document.getElementsByTagName("head").item(0).appendChild(oScript);
                            //
                            g_CSLoading = true;
                    }

                }
                

}
objcomSlider1320 = new comSlider1320();
objcomSlider1320.include('comslider1320/js/helpers.js', false);
objcomSlider1320.include('comslider1320/js/jquery-1.7.1.js', false);
objcomSlider1320.include('comslider1320/js/jquery.effects.1.5.2.js', true);
