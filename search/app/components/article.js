import React, { useState } from 'react';

function utf8_to_str(a) {
  for(var i=0, s=''; i<a.length; i++) {
      var h = a[i].toString(16)
      if(h.length < 2) h = '0' + h
      s += '%' + h
  }
  return decodeURIComponent(s)
}

const Article = ({
  className,
  data,
}) => {
  let authors = [];
  if (data.coauthors) {
    authors = data.coauthors.map(coauthor => {
      return (
        <div className="article-author">
          <div className="author-avatar" style={{ backgroundImage : `url(${coauthor.avatar})` }}></div>
          <p className="author-name">{coauthor.name}</p>
        </div>
      )
    })
  }

  return (
    <a className={'article ' + className} href={data.link} target="_blank">
      <div className="article-top-container">
        <div className="article-thumbnail" style={{ backgroundImage : `url(${data.image})` }}>

        </div>
        <div className="article-headline-container">
          {data.meta.kicker &&
                  
            <p className="article-kicker" dangerouslySetInnerHTML={{__html : data.meta.kicker}}></p>
          }  
          <p className="article-headline" dangerouslySetInnerHTML={{__html : data.title.rendered}}></p>
        </div>
      </div>
      <div className="article-authors">{authors}</div>
    </a>
  )
}

export default Article;