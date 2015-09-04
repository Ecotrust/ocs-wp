//unpacked, because, linters.

var projectId = window.MTIProjectId,
	mtiTracking = document.createElement('link');
mtiTracking.type = 'text/css';
mtiTracking.rel = 'stylesheet';
mtiTracking.href = ('https:' === document.location.protocol ? 'https:' : 'http:') + '//fast.fonts.net/t/1.css?apiType=css&projectid=' + projectId;
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mtiTracking);

