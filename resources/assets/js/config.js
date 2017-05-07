var AppConfig = {
    defaultAppTheme: {
        primary: 'blue',
        accent: 'pink',
        warn: 'red'
    },
    axiosHeader: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken,
        'X-Requested-With': 'XMLHttpRequest'
    },
    validatorConfig: {}
};

export default AppConfig;