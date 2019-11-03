import React, { useState } from 'react';

import Logo from '../elements/logo.js'
import Loading from '../elements/loading.js'

const Header = ({
  className,
  onSearchQuery,
  status,
}) => {
  let [words, setWords] = useState('');

  function onInputChange(e) {
    let query = e.nativeEvent.target.value;

    if (query != '') {
      setWords('with-words');
    } else {
      setWords('');
    }

    if (onSearchQuery && typeof onSearchQuery == "function") {
      onSearchQuery(query);
    }
  }

  return (
    <div className={ "header-container " + words }>
      <div className="logo-container">
        <Logo color="#ffffff" height="32pt" width="auto" className="logo" />
      </div>
      <div className="searchbar-container">
        <input type="text" onChange={onInputChange} placeholder="Search" className="searchbar" autoFocus={true} />
      </div>

      <div className="search-status-container">
        <div className={"search-status " + status}>
          {status === 'waiting' &&
            <Loading size="16pt" className="loading-dingling" color="#4278FF" />
          }
        </div>
      </div>
    </div>
  )
}

export default Header;