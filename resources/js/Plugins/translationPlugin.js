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
    }
}
