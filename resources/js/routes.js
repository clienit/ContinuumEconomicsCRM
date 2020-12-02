import ClientPage from './Components/Pages/ClientPage.vue';
import TransactionPage from './Components/Pages/TransactionPage.vue';
 
export const routes = [
    {
        name: 'client-page',
        path: '/client-page',
        component: ClientPage
    },
    {
        name: 'transaction-page',
        path: '/transaction-page',
        component: TransactionPage
    }
];
