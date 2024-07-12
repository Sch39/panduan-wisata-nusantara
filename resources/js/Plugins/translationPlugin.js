
export default {
    install(app, options) {
        const prop = options.prop || 'language';
        app.config.globalProperties.__ = function(key, replace = {}) {
            let keys = key.split('.');
            let translation = this.$page.props[prop];

            keys.forEach(function(keyTmp) {
                translation = translation[keyTmp] ? translation[keyTmp] : keyTmp;
            });

            Object.keys(replace).forEach(function(key) {
                translation = translation.replace(':' + key, replace[key]);
            });

            return translation;
        }

        app.config.globalProperties.$translateWithLinks = function(key, links = {}) {
            let translatedText = this.__(key);
            const result = [];
            const regex = /:(\w+)/g; // Matches placeholders like :create_account
            let match;
            let lastIndex = 0;

            while ((match = regex.exec(translatedText)) !== null) {
                // Add the text before the placeholder
                if (match.index > lastIndex) {
                    result.push({
                        type: 'text',
                        value: translatedText.slice(lastIndex, match.index),
                    });
                }

                const key = match[1];
                if (links[key]) {
                    // Add the link object
                    result.push({
                        type: 'link',
                        text: links[key].text,
                        href: links[key].href,
                    });
                }

                lastIndex = regex.lastIndex;
            }

            // Add any remaining text after the last placeholder
            if (lastIndex < translatedText.length) {
                result.push({
                    type: 'text',
                    value: translatedText.slice(lastIndex),
                });
            }

            return result;
        }
    }
}
