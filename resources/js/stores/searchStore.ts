import { defineStore } from 'pinia';
import axios from 'axios';

interface Joke {
    joke_id: number;
    value: string;
}

interface SearchStoreState {
    searchTerm: string;
    isSearching: boolean;
    jokes: Joke[];
    total: number;
    currentPage: number;
    lastPage: number;
    perPage: number;
}

export const useSearchStore = defineStore('searchStore', {
    state: (): SearchStoreState => ({
        searchTerm: '',
        isSearching: false,
        jokes: [],
        total: 0,
        currentPage: 1,
        lastPage: 1,
        perPage: 6,
    }),
    getters: {
        hasJokes(state) {
            return state.jokes?.length > 0;
        },
        needsPagination(state) {
            return state.total > 6;
        },
        hasNextPage(state): boolean {
            return state.currentPage < state.lastPage;
        },
        hasPreviousPage(state): boolean {
            return state.currentPage > 1;
        },
        counter(state) {
            return state.total;
        },
    },

    actions: {
        async analyzeJokes() {
            try {
                const response = await axios.get('/analyze', {
                    params: { words: this.searchTerm },
                });
                console.log(response);
            } catch (error) {
                console.log(error);
            }
        },
        /**
         * @param term The search term entered by the user.
         * @param page The page number to fetch.
         */
        async fetchJokes(term: string, page: number = 1) {
            const trimmedTerm = term.trim();

            if (!trimmedTerm) {
                this.jokes = [];
                this.total = 0;
                this.currentPage = 1;
                this.lastPage = 1;
                return;
            }

            this.isSearching = true;
            try {
                const response = await axios.get('/search', {
                    params: { q: trimmedTerm, page, per_page: this.perPage },
                });

                this.jokes = response.data.data;
                this.total = response.data.total;
                this.currentPage = response.data.current_page;
                this.lastPage = response.data.last_page;
            } catch (error) {
                console.error('Error fetching jokes:', error);
            } finally {
                this.isSearching = false;
            }
        },

        nextPage() {
            if (this.hasNextPage) {
                this.currentPage += 1;
                this.fetchJokes(this.searchTerm, this.currentPage);
            }
        },

        previousPage() {
            if (this.hasPreviousPage) {
                this.currentPage -= 1;
                this.fetchJokes(this.searchTerm, this.currentPage);
            }
        },
    },
});
