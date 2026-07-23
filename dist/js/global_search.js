document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('globalSearchTrigger');
    const overlay = document.getElementById('globalSearchOverlay');
    const closeBtn = document.getElementById('globalSearchClose');
    const input = document.getElementById('globalSearchInput');
    
    const stateInitial = document.getElementById('globalSearchInitial');
    const stateLoading = document.getElementById('globalSearchLoading');
    const stateEmpty = document.getElementById('globalSearchEmpty');
    const resultsContainer = document.getElementById('globalSearchResults');

    let debounceTimeout = null;
    let selectedIndex = -1;
    let currentResults = [];

    // Open Modal
    function openSearch() {
        overlay.classList.add('active');
        input.value = '';
        showState('initial');
        setTimeout(() => input.focus(), 100);
        document.body.style.overflow = 'hidden';
    }

    // Close Modal
    function closeSearch() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Toggle states
    function showState(state) {
        stateInitial.style.display = state === 'initial' ? 'flex' : 'none';
        stateLoading.style.display = state === 'loading' ? 'flex' : 'none';
        stateEmpty.style.display = state === 'empty' ? 'flex' : 'none';
        resultsContainer.style.display = state === 'results' ? 'flex' : 'none';
    }

    if (trigger) {
        trigger.addEventListener('click', openSearch);
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeSearch);
    }

    if (overlay) {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeSearch();
        });
    }

    // Global shortcut Ctrl+K or Cmd+K
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openSearch();
        }
        if (e.key === 'Escape' && overlay.classList.contains('active')) {
            closeSearch();
        }
    });

    // Keyboard navigation within results
    input.addEventListener('keydown', (e) => {
        if (state === 'results' && currentResults.length > 0) {
            const items = resultsContainer.querySelectorAll('.search-result-item');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = (selectedIndex + 1) % items.length;
                updateSelection(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = (selectedIndex - 1 + items.length) % items.length;
                updateSelection(items);
            } else if (e.key === 'Enter' && selectedIndex >= 0) {
                e.preventDefault();
                items[selectedIndex].click();
            }
        }
    });

    function updateSelection(items) {
        items.forEach((item, index) => {
            if (index === selectedIndex) {
                item.classList.add('selected');
                item.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
            } else {
                item.classList.remove('selected');
            }
        });
    }

    // Handle Input
    input.addEventListener('input', (e) => {
        const query = e.target.value.trim();
        if (query.length === 0) {
            showState('initial');
            return;
        }

        showState('loading');
        clearTimeout(debounceTimeout);
        
        debounceTimeout = setTimeout(() => {
            fetchResults(query);
        }, 300); // 300ms debounce
    });

    let state = 'initial';

    async function fetchResults(query) {
        try {
            const data = await $.ajax({
                url: `api/global_search.php?q=${encodeURIComponent(query)}`,
                method: 'GET',
                dataType: 'json'
            });
            
            if (data.status === 'success') {
                renderResults(data.data);
            } else {
                showState('empty');
            }
        } catch (error) {
            console.error("Search error:", error);
            showState('empty');
        }
    }

    function renderResults(data) {
        resultsContainer.innerHTML = '';
        currentResults = [];
        selectedIndex = -1;
        let totalCount = 0;

        const categories = [
            { key: 'faculty', label: 'Faculty & Staff' },
            { key: 'publications', label: 'Publications' },
            { key: 'patents', label: 'Patents' },
            { key: 'projects', label: 'Projects' },
            { key: 'centers', label: 'Research Centers' },
            { key: 'events', label: 'Seminars & Events' },
            { key: 'students', label: 'Students & Scholars' },
            { key: 'notices', label: 'Notices & Announcements' }
        ];

        categories.forEach(cat => {
            if (data[cat.key] && data[cat.key].length > 0) {
                totalCount += data[cat.key].length;
                
                const catDiv = document.createElement('div');
                catDiv.className = 'search-category';
                
                const title = document.createElement('div');
                title.className = 'search-category-title';
                title.textContent = cat.label;
                catDiv.appendChild(title);

                data[cat.key].forEach(item => {
                    currentResults.push(item);
                    const link = document.createElement('a');
                    link.className = 'search-result-item';
                    link.href = item.url;
                    
                    const itemTitle = document.createElement('div');
                    itemTitle.className = 'search-result-title';
                    itemTitle.textContent = item.title;
                    
                    const itemSub = document.createElement('div');
                    itemSub.className = 'search-result-subtitle';
                    itemSub.textContent = item.subtitle;
                    
                    link.appendChild(itemTitle);
                    link.appendChild(itemSub);
                    catDiv.appendChild(link);
                });
                
                resultsContainer.appendChild(catDiv);
            }
        });

        if (totalCount === 0) {
            state = 'empty';
            showState('empty');
        } else {
            state = 'results';
            showState('results');
        }
    }
});

// Highlight Logic for Search Results Landing
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const highlightText = urlParams.get('highlight_text');
    
    if (highlightText) {
        // Wait a small amount for dynamic rendering (if any)
        setTimeout(() => {
            const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
            let node;
            
            while (node = walker.nextNode()) {
                // Exclude script, style tags, and breadcrumbs
                if (node.parentElement.tagName === 'SCRIPT' || node.parentElement.tagName === 'STYLE' || node.parentElement.closest('.sisas-breadcrumb-container')) {
                    continue;
                }
                
                if (node.nodeValue.trim().toLowerCase() === highlightText.toLowerCase() || 
                    node.nodeValue.trim().toLowerCase().includes(highlightText.toLowerCase())) {
                    
                    let foundElement = node.parentElement;
                    // Find a suitable container to highlight rather than just a span
                    let container = foundElement.closest('.card, tr, .faculty-card, .publication-card, .event-card, li') || foundElement;
                    
                    // Scroll into view
                    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Apply highlight transition
                    const originalBg = container.style.backgroundColor;
                    const originalTransition = container.style.transition;
                    
                    container.style.transition = 'background-color 0.5s ease, box-shadow 0.5s ease';
                    container.style.backgroundColor = 'rgba(16, 185, 129, 0.15)'; // Emerald tint
                    container.style.boxShadow = '0 0 15px rgba(16, 185, 129, 0.4)';
                    
                    // Remove highlight after 3 seconds
                    setTimeout(() => {
                        container.style.backgroundColor = originalBg;
                        container.style.boxShadow = '';
                        setTimeout(() => {
                            container.style.transition = originalTransition;
                        }, 500);
                    }, 3000);
                    
                    break; // Just highlight the first match
                }
            }
        }, 300);
    }
});

