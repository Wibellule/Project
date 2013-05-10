/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.addTemplates(
	'default', {
		imagesPath:CKEDITOR.getUrl(CKEDITOR.plugins.getPath('templates')+'templates/images/'),
		templates:[
			{
				title:'Img Slider',
				image:'txt_categorie.gif',
				description:'',
				html:''+
						'<article class="slide"><img src="/Project/webroot/upload/images/features_img_1.jpg" alt="" class="slide-bg-image" />' +
						'<div class="slide-button">' +
						'<span class="dropcap">1</span>' +
						'<h5>Responsive Layout</h5>' +
						'<span class="description">From desktop to mobile</span>' +
						'</div>' +
						'<div class="slide-content">' +
						'<h2>Responsive Layout</h2>' +
						'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>' +
						'<p><a class="button" href="#">Read More</a></p>' +
						'</div>' +
						'</article>'
			},
			{
				title:'Projet Animation Design',
				image:'txt_categorie.gif',
				description:'',
				html:''+
						'<article class="one-fourth" data-categories="animation design">' +
						'<a href="http://player.vimeo.com/video/20552845?byline=0&amp;portrait=0" class="iframe video" title="Boombox -">' +
						'<img alt="" src="/Project/webroot/upload/images/boombox-thumb-4th.jpg" style="width: 220px; height: 140px;" />' +
						'</a>' +
						'<a href="#" class="project-meta">' +
						'<h5 class="title">Altered</h5>' +
						'<span class="categories">animation / design</span>' +
						'</a>' +
						'</article>'
			},
			{
				title:'Projet Illustration Design',
				image:'txt_categorie.gif',
				description:'',
				html:''+
						'<article class="one-fourth" data-categories="animation design">' +
						'<a href="#" class="single-image" title="">' +
						'<img alt="" src="/Project/webroot/upload/images/boombox-thumb-4th.jpg" style="width: 220px; height: 140px;" />' +
						'</a>' +
						'<a href="#" class="project-meta">' +
						'<h5 class="title">Boombox</h5>' +
						'<span class="categories">illustration / design</span>' +
						'</a>' +
						'</article>'
			},
			{
				title:'Exemple article blog',
				image:'txt_categorie.gif',
				description:'',
				html:''+
						'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>' +
						'<p>Maecenas pulvinar blandit facilisis. Curabitur mollis nisl non purus ultrices convallis. Ut volutpat tristique nisl elementum ultricies. Etiam vitae neque leo. Donec eget turpis lorem. Nulla facilisi. Duis bibendum diam sed ligula euismod a interdum ipsum semper. Curabitur id lectus pulvinar erat pretium aliquet. Ut felis enim, congue ac ullamcorper id, luctus congue neque. Praesent augue mauris, lacinia quis auctor nec, vestibulum suscipit ligula. Nunc elit nisl, mollis ut consequat a, sodales eu tortor. Aenean egestas, nisi a iaculis lacinia, mauris dui accumsan dui, vel scelerisque neque nibh sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>' +
						'<blockquote>Praesent bibendum lobortis lectus, quis dictum risus faucibus sagittis. Mauris a placerat lacus. Mauris rhoncus dolor sit amet nisl volutpat at consequat tortor feugiat. Ut ornare dui eu ipsum lobortis rhoncus.</blockquote>' +
						'<p>Quisque odio urna, ultrices non volutpat lacinia, scelerisque sit amet justo. Quisque venenatis sapien id eros pulvinar sit amet posuere lacus gravida. Aenean accumsan placerat nulla, dictum semper turpis scelerisque sit amet. Cras et quam lorem. Fusce rhoncus consequat nulla ut gravida. Sed adipiscing, lacus ac commodo scelerisque, est erat eleifend augue, nec viverra ligula lacus sed arcu. Suspendisse eu massa quis tellus dapibus dignissim suscipit eget est. Sed ullamcorper elit a arcu consequat in pellentesque odio volutpat. Donec dignissim porttitor consectetur. Donec risus mauris, aliquet ut ullamcorper eu, dignissim ut nulla. Pellentesque in magna eros, eget viverra nulla. In dui eros, porttitor a vehicula et, vulputate hendrerit urna. Mauris nec nibh turpis.<p>' +
						'<ul>' +
						'<li>Curabitur id lectus pulvinar</li>' +
						'<li>Ut felis enim, congue</li>' +
						'<li>Praesent augue mauris</li>' +
						'<li>Nunc elit nisl mollis</li>' +
						'</ul>' +
						'<p>Etiam auctor tincidunt augue at pharetra. Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus scelerisque tincidunt. Maecenas accumsan imperdiet faucibus. Mauris tincidunt, nulla quis rhoncus malesuada, nibh ante pulvinar dolor, ut lacinia libero risus nec orci.</p>'
			},
			{
				title:'Exemple video blog',
				image:'txt_categorie.gif',
				description:'',
				html:''+
						'<video class="entry-video video-js vjs-default-skin" poster="http://demo.samuli.me/_media/smartstart-wp/taste-lab.jpg" data-aspect-ratio="1.78" data-setup="{}" controls>' +
						'<source src="http://demo.samuli.me/_media/smartstart-wp/taste-lab.mp4video.mp4" type="video/mp4" />' +
						'</video>'
			}
		]
	}
);