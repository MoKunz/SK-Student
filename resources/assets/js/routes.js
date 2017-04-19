// Import app component
// News
import News from './components/news/News.vue';
import NewsBar from './components/news/NewsBar.vue';
import AddNews from './components/news/AddNews.vue';
// Timeline
import Timeline from './components/timeline/Timeline.vue';
// Account
import Account from './components/account/Account.vue';
import AccountBar from './components/account/AccountBar.vue';
import AccountLogin from './components/account/AccountLogin.vue';
import AccountRegister from './components/account/AccountRegister.vue';

export default [
    // News app
    {
        name: 'news',
        path: '/app/news',
        components: {
            default: News,
            appBar: NewsBar
        },
        meta: {
            title: 'News',
        },
    },
    // News add
    {
        name: 'news-add',
        path: '/app/news/add',
        meta: {
            title: 'Add News',
        },
        components: {
            default: News,
            appBar: NewsBar,
            overlay: AddNews
        }
    },
    // Timeline app
    {
        name: 'timeline',
        path: '/app/timeline',
        meta: {
            title: 'Timeline',
        },
        components: {
            default: Timeline
        }
    },
    // Account app
    {
        name: 'account',
        path: '/app/account',
        meta: {
            title: 'Account',
        },
        components: {
            default: Account,
            appBar: AccountBar,
        }
    },
    // Account login
    {
        name: 'account-login',
        path: '/app/account/login',
        meta: {
            title: 'Account',
        },
        components: {
            default: Account,
            appBar: AccountBar,
            overlay: AccountLogin
        }
    },
    // Account register
    {
        name: 'account-register',
        path: '/app/account/register',
        meta: {
            title: 'Register',
        },
        components: {
            default: Account,
            appBar: AccountBar,
            overlay: AccountRegister
        }
    }
];