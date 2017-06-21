import axios from 'axios'
/**
 * TODO: Migrate code from News.vue
 */
export default class NewsData {
    constructor(app) {
        this.app = app;
        this.data = [];
    }

    count() {
        return this.data.length;
    }

    raw() {
        return this.data;
    }

    load(total = 10, skip = 0) {

    }

    clear() {
        this.data = [];
    }
}
