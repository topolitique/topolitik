import React, { useEffect, useState, useRef } from 'react';

import Posts from './posts.json';

import { 
  mediaURL, 
  searchTheAPI
} from './data';

import Header from './components/header'
import Article from './components/article'

const App = () => {
  const updateTimer = useRef(null);
  /* background images */
  const [image, setImage] = useState('');
  /* search values */
  const [status, setStatus] = useState('none'); // none, waiting, ok, error
  const [query, setQuery] = useState('');
  const [results, setResults] = useState([]);

  useEffect( () => {
    /* background image */
    fetch(mediaURL)
      .then(response => response.json())
      .then(response => {
        let imgs = []
        for (let index = 0; index < response.length; index++) {
          const img = response[index].source_url;
          imgs.push(img);
        }
        let index = Math.floor(Math.random() * (imgs.length - 1)) + 1;
        setImage(imgs[index])
      })
  }, [])

  useEffect(() => {
    if (query != '') {
      setStatus('waiting')
      /* query API */
      searchTheAPI({ query })
        .then(response => response.json())
        .catch(e => {
          setStatus('error')
        })
        .then(results => {
          setResults(results)
          setStatus('ok')
        })
        .catch(e => {
          setStatus('error')
        })

    } else {
      setStatus('none')
      setResults([])
    }
  }, [query])

  let resultElements = results.map(result => {
    let extraClass = 'normal';
    let words = query.split(' ');
    words.forEach(w => {
      if (String(result.title.rendered).toLowerCase().includes(w.toLowerCase())) {
        extraClass = 'featured'
      }
    })
    return (
      <Article key={result.id} data={result} className={extraClass} />
    )
  })
  return (
    <div className="root" >
      <div className="backgroundImage" style={{ backgroundImage: `url(${image})` }}></div>
      <Header onSearchQuery={setQuery} status={status} />
      <div className="articles">{resultElements}</div>
    </div>
  )
}

export default App;