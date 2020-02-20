function sbg() {
	var buttons = document.getElementsByClassName('share-btn');

	for (let i = 0; i < buttons.length; i++) {
		var button = buttons[i];
		var network = button.getAttribute('data-sbg-network');

		if (button.hasAttribute('data-sbg-isBinded')) {
			continue;
		}
		button.setAttribute('data-sbg-isBinded', 'true');

		bindButton(network, button);
	}

	function bindButton(network,button) {
		var height = button.getAttribute('data-sbg-height'),
			width = button.getAttribute('data-sbg-width'),
			top = Math.max(0, (screen.height - height) / 2),
			left = Math.max(0, (screen.width - width) / 2),
			specs = 'height=' + height + ',width=' + width + ',top=' + top + ',left=' + left + ',status=0,toolbar=0,directories=0,location=0' + ',menubar=0,resizable=1,scrollbars=1', 
			windowName = 'sbg-window-' + Math.random();
		var url;
		switch (network) {
			case 'facebook':
				url = buildUrl('http://www.facebook.com/sharer.php', {
					's': 100,
					'p[url]': button.getAttribute('data-sbg-url'),
					'p[title]': button.getAttribute('data-sbg-title'),
					'p[summary]': button.getAttribute('data-sbg-summary'),
					'p[images][0]': button.getAttribute('data-sbg-image')
				});
				button.onclick = function() {
					window.open(url, windowName, specs);
				};
				break;
			case 'twitter':
				url = buildUrl('http://twitter.com/intent/tweet', {
					'text': button.getAttribute('data-sbg-text'),
					'via': button.getAttribute('data-sbg-via'),
					'hashtags': button.getAttribute('data-sbg-hashtags')
				});
				button.onclick = function() {
					window.open(url, windowName, specs);
				}
				break;
		}
	}

	function buildUrl(url, parameters) {
		var qs = '';
		for (let key in parameters) {
			let value = parameters[key];
			if (! value) {
				continue;
			}
			value = value.toString().split('\"').join('"');
			qs += key + "=" + encodeURIComponent(value) + "&";
		}
		if (0 < qs.length) {
			qs = qs.substring(0, qs.length - 1);
			url = url + '?' + qs;
		}
		return url;
	}
}

sbg();
