import axios from 'axios'
export default class AccountSystem {
    constructor(app) {
        this.app = app;
        this.loggedIn = false;
        this.data = {
            'name': 'Guest'
        };
    }

    sync() {
        axios.get(APP_API_ENTRY + '/account/current').then(
            (response) => {
                var data = response.data;
                this._updateAccount(data.loggedIn, data.user);
            }
        ).catch(
            (error) => {
                console.error(error)
            }
        );
    }

    _updateAccount(loggedIn, userData) {
        this.loggedIn = loggedIn;
        this.data = userData;
    }

    login(username, password) {
        return new Promise(
            (resolve, reject) => {
                axios.post(APP_API_ENTRY + '/account/login', {
                    'username': username,
                    'password': password
                }).then(
                    (resp) => {
                        var data = resp.data;
                        if (data.success) {
                            this._updateAccount(true, data.user);
                            resolve(data.user);
                        }
                        else {
                            reject('Login failed');
                        }
                    }
                ).catch(
                    (err) => reject(err)
                );
            }
        );
    }

    logout() {
        return new Promise(
            (resolve, reject) => {
                axios.post(APP_API_ENTRY + '/account/logout').then(
                    (resp) => {
                        resolve(resp)
                    }
                ).catch(
                    (err) => reject(err)
                );
            }
        );
    }
}
